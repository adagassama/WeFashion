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
    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 col-md-6">

                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" minlength="5" maxlength="100" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    @if($errors->has('name')) <span class="error bg-warning text-warning">{{$errors->first('name')}}</span>@endif
                </div><br>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @if($errors->has('description')) <span class="error bg-warning text-warning">{{$errors->first('description')}}</span> @endif
                </div><br>


                <div class="form-group">
                    <label for="category">Catégories :</label><br>
                    <select id="category" name="category_id">
                        <option value="0" >Faites un choix</option>
                        @foreach($categories as $id => $name)
                            <option {{ old('category_id')==$id? 'selected' : '' }} value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>

                </div><br>


                <div class="form-group">
                    <label for="reference">Référence</label>
                    <input type="text" minlength="16" maxlength="16" class="form-control" id="reference" name="reference" value="{{ old('reference') }}" required>
                </div><br>

                <div class="form-group">
                    <label>Choisissez les tailles</label> <br>
                    @error('sizes')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @foreach ($sizes as $size)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="sizes[]" id="{{ $size }}" value="{{ $size }}" @if(in_array($size, old('sizes') ?? [])) checked @endif>
                            <label class="form-check-label" for="{{ $size }}">{{ $size }}</label>
                        </div>
                    @endforeach
                </div>

            </div><br>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="price">Prix</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" min="0.01" max="9999.99" value="{{ old('price') }}" required>
                </div><br>

                <div class="form-group">
                    <label>Visibilité</label> <br>
                    @error('published')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="published1" name="visibility" value="1" @if(old('published') == 1) checked @endif>
                        <label class="form-check-label" for="published1">Publié</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="published0" name="visibility" value="0" @if(null !== old('published') && (old('published') == 0)) checked @endif>
                        <label class="form-check-label" for="published0">Non-Publié</label>
                    </div>
                </div><br>

                <div class="form-group">
                    <label>Statut</label> <br>
                    @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="status0" name="status" value="1" @if(old('status') == 1) checked @endif>
                        <label class="form-check-label" for="status0">Standard</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="status1" name="status" value="0" @if(null !== old('status') && (old('status') == 0)) checked @endif>
                        <label class="form-check-label" for="status1">Solde</label>
                    </div>
                </div><br>

                <div class="form-group">
                    <input type="file" class="form-control-file" name="picture" id="picture">
                </div><br>

                <div class="form-group">
                    <label for="picture_title">Titre de la photo</label>
                    <input type="text" maxlength="100" class="form-control" id="picture_title" name="picture_title" value="{{ old('picture_title') }}">
                </div><br>

                <button type="submit" class="btn btn-primary">Enregistrer</button>

            </div>
        </div>
    </form>
<div class="m-xl-4">

</div>
@endsection
