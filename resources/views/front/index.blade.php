@extends('layouts.master')

@section('content')

    <div class="container">
        <h1 class="title">Bienvenue dans la Boutique WEFASHION</h1>
        <div class="row">
            {{$products->links()}}
            <p class="text-md-end">{{ $products->total() }} résultats</p>
            @foreach ($products as $product)
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{url('product', $product->id)}}">
                                <div class="new-arrival-product">
                                    <div class="new-arrivals-img-content" >
                                        <img class="card-img-top" src="{{ asset('imagesss/'.$product->picture->link) }}" alt="">
                                    </div>
                                    <div class="new-arrival-content text-center mt-3">
                                        <h5><a href="{{url('product', $product->id)}}">{{$product->name}}</a></h5>
                                        <span class="price">{{ $product->price }} €</span><br>
                                        <button type="button" class="btn btn-primary">Ajouter au panier</button><br>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="m-xl-4 col-lg-6">
            {{$products->links()}}
        </div>
    </div>
@endsection
