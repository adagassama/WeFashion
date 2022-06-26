@extends('layouts.app')

@section('CSS')
    <style>
        .error {
            color: red;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="registration-form">

            <div class="card">
                <div class="card-header create-title"><h3>@if (Route::is('category.create')){{ 'CREATION DE NOUVELLE CATEGORIE' }}@else{{'MODIFICATION DE CATEGORIE'}}@endif</h3></div>
                <div class="card-body">
        @if (Route::is('category.create'))
            <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
        @else
            <form action="{{route('category.update',$category->id)}}" method="post" enctype="multipart/form-data">
             @method ('PUT')
        @endif
            @csrf
            <div class="row">


                        <div class="form-group">
                            <label for="name" class="etiquette">NOM DE LA CATEGORIE</label>
                            <input type="text" minlength="5" maxlength="100" class="form-control item" id="name" name="name" value="{{ old('name', ($category->name)??'') }}" required>
                            @if($errors->has('name')) <span class="error bg-warning text-warning">{{$errors->first('name')}}</span>@endif
                        </div><br>

                    @if (Route::is('category.edit'))
                        <button type="submit" class="btn btn-block create-account btn-lg btn-block">Mettre à jour</button>
                    @endif
                    @if(Route::is('category.create'))
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
