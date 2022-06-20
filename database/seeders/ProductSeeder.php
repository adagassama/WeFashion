<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('local')->delete(Storage::allFiles());

        Category::factory()->create([
            'name' => 'Homme'
        ]);
        Category::factory()->create([
            'name' => 'Femme'
        ]);

        Size::factory()->create([
            'name' => 'XS'
        ]);
        Size::factory()->create([
            'name' => 'S'
        ]);
        Size::factory()->create([
            'name' => 'M'
        ]);
        Size::factory()->create([
            'name' => 'L'
        ]);
        Size::factory()->create([
            'name' => 'XL'
        ]);

        Product::factory(80)->create()->each(function ($product){

            $category = Category::find(rand(1,2));

            $product->category()->associate($category);

            $product->save();

            $folder = $product->category_id == 1 ? 'homme' : 'femme';

            $link = Str::random(12). '.jpg';

            $file = file_get_contents(public_path('images/' . $folder . '/' . rand(1, 10) . '.jpg'));
            Storage::disk('local')->put($link, $file);

            $product->picture()->create([
                'title' => 'Default', // valeur par défaut
                'link' => $link
            ]);


            //$sizes = Size::find(rand(1,5));
            $sizes =Size::pluck('id')->shuffle()->slice(0,rand(1,5))->all();

            // Il faut se mettre maintenant en relation avec les auteurs (relation ManyToMany) et attacher les id des auteurs
            // dans la table de liaison.
            $product->sizes()->attach($sizes);
        });
    }
}
