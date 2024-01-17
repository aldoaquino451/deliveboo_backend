@extends('layouts.admin')
@section('content')
    <div class="container px-5 py-3">

        <h4 class="mb-4">Modifica i dati</h4>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <p>Uno o più campi non sono compilati correttamente</p>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product) }}" method="POST" class="row g-3"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- <div class="col-md-8">
                <label for="name" class="form-label">Nome prodotto</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product['name'] }}">
            </div>
            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror --}}

            <div class="col-md-6">
                <label for="name" class="form-label">Nome prodotto</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $product->name) }}">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>


            <div class="col-md-2">
                <label for="price" class="form-label">Prezzo</label>
                <input type="number" step=0.01 min=0 class="form-control @error('price') is-invalid @enderror"
                    id="price" name="price" value="{{ old('price', $product->price) }}">
                @error('price')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-12">
                <label for="ingredients" class="form-label @error('ingredients') is-invalid @enderror">Ingredienti</label>
                <textarea class="form-control" id="ingredients" placeholder="Lista Ingredienti" name="ingredients">{{ old('ingredients', $product->ingredients) }}</textarea>
                @error('ingredients')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            {{-- <div class="col-12">
                <label for="image" class="form-label">Immagine</label>
                <input id="image" class="form-control" name="image" type="file">
            </div> --}}


            {{-- <div class="col-md-8">
                <label for="category_id" class="form-label">Categoria</label>
                <select id="category_id" class="form-select" name="category_id">
                    <option selected>Seleziona</option>
                    @foreach ($categories as $category)
                        <option @if ($category->id === $product->category_id) selected @endif value="{{ $category->id }}">
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div> --}}

            <div class="col-md-8">
                <label for="category_id" class="form-label">Categoria</label>
                <select id="category_id" class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                    <option value=0 selected>Seleziona</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach

                </select>
                @error('category_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-md-12 ">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_visible" name="is_visible" value="1"
                        {{ old('is_visible', $product->is_visible) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_visible">
                        Visibile
                    </label>
                </div>
                <div class="form-check">
                    <input @if ($product->is_vegan) checked @endif class="form-check-input" type="checkbox"
                        id="is_vegan" name="is_vegan" value="1" {{ old('is_vegan') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_vegan">
                        Vegano
                    </label>
                </div>
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary">Modifica</button>
            </div>
        </form>

    </div>
@endsection
