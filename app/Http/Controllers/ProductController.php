<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $paginate = 15;

    public function __construct(){

        // méthode pour injecter des données à une vue partielle
        view()->composer('partials.menu', function($view){
            $categories = Category::pluck('name', 'id')->all(); // on récupère un tableau associatif ['id' => 1]
            $view->with('categories', $categories ); // on passe les données à la vue
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate($this->paginate);
        return view('back.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // permet de récupérer une collection type array avec en clé id => name
        $sizes = Size::pluck('name', 'id')->all();
        $categories = Category::pluck('name', 'id')->all();

        return view('back.product.create', ['sizes' => $sizes, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|string',
            'category_id' => 'integer',
            'sizes.*' => 'integer', // pour vérifier un tableau d'entiers il faut mettre authors.*
            'visibility' => 'in:published,unpublished',
            'picture_title' => 'string|nullable', // pour le titre de l'image si il existe
            'picture' => 'image|max:3000',
            'reference' => 'string',
            'status' => 'string'
        ]);

        $product = Product::create($request->all()); // associé les fillables



        $product->sizes()->attach($request->sizes);

        // image
        $im = $request->file('picture');

        // si on associe une image à un produit
        if (!empty($im)) {

            $link = $request->file('picture')->store('images');

            // mettre à jour la table picture pour le lien vers l'image dans la base de données;
            $product->picture()->create([
                'link' => $link,
                'title' => $request->title_image?? $request->title_image
            ]);
        }

        return redirect()->route('product.index')->with('message', 'Le produit a été ajouté avec succès');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('back.product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $sizes = Size::pluck('name', 'id')->all();
        $allSizes = [];
        foreach ($product->sizes as $productSize) {
            $allSizes[] = $productSize->id;
        }
        $categories = Category::pluck('name', 'id')->all();

        return view('back.product.create', compact('product', 'sizes', 'categories','allSizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|string',
            'category_id' => 'integer',
            'sizes.*' => 'integer', // pour vérifier un tableau d'entiers il faut mettre authors.*
            'visibility' => 'in:published,unpublished',
            'picture_title' => 'string|nullable', // pour le titre de l'image si il existe
            'picture' => 'image|max:3000',
            'reference' => 'string',
            'status' => 'string'
        ]);

        $product =Product::find($id); // associé les fillables

        $product->update($request->all());

        // on utilisera la méthode sync pour mettre à jour les auteurs dans la table de liaison
        $product->sizes()->sync($request->sizes);


        // image
        $im = $request->file('picture');

        // si on associe une image à un produit
        if (!empty($im)) {

            $link = $request->file('picture')->store('images');

            // suppression de l'image si elle existe
                Storage::disk('local')->delete($product->picture->link); // supprimer physiquement l'image
                $product->picture()->delete(); // supprimer l'information en base de données


            // mettre à jour la table picture pour le lien vers l'image dans la base de données
            $product->picture()->create([
                'link' => $link,
                'title' => $picture_title?? 'Titre'
            ]);

        }
        return redirect()->route('product.index')->with('message', 'Le produit a été modifié avec succès');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->route('product.index')->with('message', 'produit supprimé avec succès');
    }
}
