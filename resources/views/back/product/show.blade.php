@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <a href="#" class="thumbnail">
                <img width="200" src="{{asset('imagesss/'.$product->picture->link)}}" alt="{{$product->picture->title}}">
            </a>
        </div>
        <div class="col-12 col-md-6 my-4 my-md-0">
            <p class="product-title"><h2>{{$product->title}}</h2></p><br>

            <div>
                <p>{{ $product->description }}</p>
                <p><strong>Référence produit : </strong>{{ $product->reference }} </p>
            </div>


            <p><strong>Price : </strong>{{ $product->price }} € TTC</p>

            <strong>Taille :  </strong><select class="custom-select my-4">
                <option selected disabled>{{ $product->size }}</option>


            </select><br><br>

            <button type="button" class="btn btn-primary">Ajouter au panier</button>
        </div>
    </div>
@endsection

