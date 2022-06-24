@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-5 col-lg-6 col-md-6 col-sm-6">
            <a href="#" class="thumbnail">
                <img class="w-100" src="{{asset('imagesss/'.$product->picture->link)}}" alt="{{$product->picture->title}}">
            </a>
        </div>
        <div class="col-12 col-md-6 my-4 my-md-0">
            <p class="product-title"><h2>{{$product->name}}</h2></p><br>

            <div>
                <p>{{ $product->description }}</p>
                <p><strong>Référence produit : </strong><span class="text-uppercase">{{ $product->reference }}</span> </p>
            </div>


            <p><strong>Price : </strong>{{ $product->price }} € TTC</p>

            <select class="custom-select my-4">
                <option selected disabled>Taille</option>
                @foreach ($product->sizes as $size)
                    <option value="{{ $size->name }}">{{ $size->name }}</option>
                @endforeach
            </select><br><br>

            <button type="button" class="btn btn-primary">Acheter</button>
        </div>
    </div>
</div>
@endsection

