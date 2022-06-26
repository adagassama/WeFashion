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
                <p><strong>REFERENCE : </strong><span class="text-uppercase">{{ $product->reference }}</span> </p>
            </div>


            <p><strong>PRIX : </strong>{{ $product->price }} € TTC</p>

            TAILLES : <select class="custom-select my-4">
                <option selected disabled>Les tailles</option>
                @foreach ($product->sizes as $size)
                    <option value="{{ $size->name }}">{{ $size->name }}</option>
                @endforeach
            </select><br><br>

            <button type="button" class="btn btn-primary">ACHETER</button>
        </div>
    </div>
</div>
@endsection

