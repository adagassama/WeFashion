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
        @if (Route::is('category.create'))
            <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
        @else
            <form action="{{route('category.update',$category->id)}}" method="post" enctype="multipart/form-data">
             @method ('PUT')
        @endif
            @csrf
            <div class="row">
                <div class="col-12 col-md-6">

                        <div class="form-group">
                            <label for="name">Nom de la catégorie</label>
                            <input type="text" minlength="5" maxlength="100" class="form-control" id="name" name="name" value="{{ old('name', ($category->name)??'') }}" required>
                            @if($errors->has('name')) <span class="error bg-warning text-warning">{{$errors->first('name')}}</span>@endif
                        </div><br>

                    @if (Route::is('category.edit'))
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    @endif
                    @if(Route::is('category.create'))
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    @endif
                </div><br>

            </div>
        </form>
        <div class="m-xl-4">

        </div>
@endsection
