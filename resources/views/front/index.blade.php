@extends('layouts.master')

@section('content')

    <div class="container">
        <h1>Tous les produits</h1>
        <div class="row">
            {{$products->links()}}
            <p class="text-md-end">{{ $products->total() }} résultats</p>
            @foreach ($products as $product)
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="new-arrival-product">
                                <div class="new-arrivals-img-content" >
                                    <img class="card-img-top" src="{{ asset('imagesss/'.$product->picture->link) }}" alt="">
                                </div>
                                <div class="new-arrival-content text-center mt-3">
                                    <h5><a href="{{url('product', $product->id)}}">{{$product->name}}</a></h5>
                                    <p class="star-rating" align="justify">{{ $product->description }}</p>
                                    <h5>Size(s):</h5>
                                    <ul>
                                        @forelse($product->sizes as $size)
                                            <a href="{{url('size', $size->id)}}">{{$size->name}}</a>
                                        @empty
                                            <li>Aucune size</li>
                                        @endforelse
                                    </ul>
                                    <span class="price">{{ $product->price }} €</span><br>
                                    <button type="button" class="btn btn-primary">Ajouter au panier</button><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-12 align-content-lg-end">
                {{ $products->links() }}
            </div>
        </div>
    </div>

@endsection
