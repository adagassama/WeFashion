@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="thumbnail-image">
            <a href="#" class="thumbnail">
                <img class="photo-produit" src="{{asset('imagesss/'.$product->picture->link)}}" alt="{{$product->picture->title}}">
            </a>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <p class="product-title"><h2>{{$product->name}}</h2></p><br>

            <div>
                <p>{{ $product->description }}</p>
                <p><strong class="etiquette">CATEGORIE : </strong><span class="text-uppercase">{{ $product->category->name}}</span> </p>
                <p><strong class="etiquette">REFERENCE : </strong><span class="text-uppercase">{{ $product->reference }}</span> </p>
                <p><strong class="etiquette">PRIX : </strong>{{ $product->price }} €</p>
                <strong class="etiquette">TAILLES :</strong> <select class="custom-select my-4">
                    <option selected disabled>Les tailles</option>
                    @foreach ($product->sizes as $size)
                        <option value="{{ $size->name }}">{{ $size->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="button" class="btn btn-primary">ACHETER</button>
        </div>
    </div>
</div>
@endsection

