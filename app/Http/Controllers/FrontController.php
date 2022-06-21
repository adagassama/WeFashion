<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    protected $paginate = 6;

    public function __construct(){

        // méthode pour injecter des données à une vue partielle
        view()->composer('partials.menu', function($view){
            $categories = Category::pluck('name', 'id')->all(); // on récupère un tableau associatif ['id' => 1]
            $view->with('categories', $categories ); // on passe les données à la vue
        });
    }

    // l'index() permet de retourner la page d'accueil Front

    public function index(){
        $products = Product::published()->paginate($this->paginate); // pagination

        return view('front.index', ['products' => $products]);

    }

    // La méthode show() permet de retourner le produit en fonction de l'id de recherche.

    public function show(int $id){

        $product = Product::find($id);

        return view('front.show', ['product' => $product]);
    }

    // La méthode showProductBySolde() permet de retourner les produits qui sont en solde

    public function showProductBySolde(){
        //
        $products = Product::with('picture')->where('status', 'SOLDE')->paginate($this->paginate);

        return view('front.index', ['products' => $products]);
    }

    public function showProductByCategory(int $id){

        $category = Category::find($id);

        $products = $category->products()->paginate($this->paginate);

        return view('front.index', ['products' => $products, 'category' => $category]);
    }
}
