@extends('layouts.app')

@section('content')
<div class="container">
    <div class="registration-form">

        <div class="card">
            <div class="card-header create-title"><h3>@if (Route::is('product.create')){{ 'CREATION DE NOUVEAU PRODUIT' }}@else{{'MODIFICATION DE PRODUIT'}}@endif</h3></div>
            <div class="card-body">
                @if (Route::is('product.create'))
                    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                        @else
                            <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
                                @method ('PUT')
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="etiquette">NOM</label>
                                            <input type="text" minlength="5" maxlength="100" class="form-control item" id="name" name="name" value="{{ old('name', ($product->name)??'') }}" required autofocus>
                                            @if($errors->has('name')) <span class="error bg-warning text-warning">{{$errors->first('name')}}</span>@endif
                                        </div>

                                        <div class="form-group">
                                            <label for="description" class="etiquette">DESCRIPTION</label>
                                            <textarea class="form-control item" id="description" name="description" rows="3">{{ old('description',($product->description)??'') }}</textarea>
                                            @if($errors->has('description')) <span class="error bg-warning text-warning">{{$errors->first('description')}}</span> @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="category" class="etiquette">CATEGORIES :</label><br>
                                            <select id="category" name="category_id" class="form-control item form-select">
                                                <option value="0" class="form-control">Faites un choix</option>

                                                @foreach($categories as $id => $name)
                                                    <option class="form-control" @selected(old('category_id', ($product->category->id)?? '') == $id) value="{{$id}}">{{$name}}</option>
                                                @endforeach

                                            </select>

                                        </div>


                                        <div class="form-group">
                                            <label for="price" class="etiquette">PRIX</label>
                                            <input type="number" class="form-control item" id="price" name="price" step="0.01" min="0.01" max="9999.99" value="{{ old('price',($product->price) ??'') }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="reference" class="etiquette">REFERENCE</label>
                                            <input type="text" minlength="16" maxlength="16" class="form-control item" id="reference" name="reference" value="{{ old('reference',($product->reference)??'') }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="picture_title" class="etiquette">TITRE DE LA PHOTO</label>
                                            <input type="text" maxlength="100" class="form-control item" id="picture_title" name="picture_title" value="{{ old('picture_title',($product->picture->title)??'') }}">
                                        </div>

                                    </div>

                                    <div class="col-12 col-md-6">

                                        <div class="form-group">
                                            <label class="etiquette">STATUT</label> <br>
                                            @error('status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="status0" name="status" @checked(old('status', ($product->status)?? '') == 'Standard') value="Standard">
                                                <label class="form-check-label" for="status0">Standard</label>
                                            </div>
                                            <div class="form-check form-check-inline item" >
                                                <input class="form-check-input" type="radio" id="status1" name="status" @checked(old('status', ($product->status)?? '') == 'Solde') value="Solde">
                                                <label class="form-check-label" for="status1">Solde</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="etiquette">CHOISIR LES TAILLES</label> <br>
                                            @error('sizes')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            @foreach ($sizes as $id => $name)
                                                <div class="form-check form-check-inline item">
                                                    <input class="form-check-input" type="checkbox" id="size{{$id}}" value="{{ $id }}" @checked (in_array( $id, old('sizes', ($allSizes)?? []) )) name="sizes[]" >
                                                    <label class="form-check-label" for="{{ $name}}">{{ $name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="form-group">
                                            <label class="etiquette">VISIBILITE</label> <br>
                                            @error('published')
                                            <div class="alert alert-danger ">{{ $message }}</div>
                                            @enderror
                                            <div class="item form-check form-check-inline">
                                                <input class="form-check-input " type="radio" id="published1" @checked(old('visibility', ($product->visibility)?? '') == 'published') value="published"  name="visibility">
                                                <label class="form-check-label" for="published1">Publié</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="published0" @checked(old('visibility', ($product->visibility)?? '') == 'unpublished') value="unpublished"  name="visibility">
                                                <label class="form-check-label" for="published0">Non-Publié</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="file" class="form-control -file" name="picture" id="picture">
                                        </div>


                                        @if (Route::is('product.edit'))
                                            <div class="form-group">
                                                <label class="etiquette">IMAGE ASSOCIEE :</label>
                                            </div>
                                            <div class="form-group-image">
                                                <img class="picture" src="{{url('imagesss', $product->picture->link)}}" alt="">
                                            </div>
                                        @endif


                                    </div>
                                </div>
                                <div>
                                    @if (Route::is('product.edit'))
                                        <button type="submit" class="btn btn-block create-account btn-lg btn-block">Modifier</button>
                                    @endif
                                    @if(Route::is('product.create'))
                                        <button type="submit" class="btn btn-block create-account btn-lg btn-block">Ajouter</button>
                                    @endif
                                </div>
                            </form>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
