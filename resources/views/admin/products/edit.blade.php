@extends('layouts.admin')
@section('content')
    <div class="container px-3 py-2 p-md-4 " style="max-width: 1000px">

        <h4 class="mb-4 mb-md-5 text-uppercase text-center">Modifica il prodotto</h4>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <p>Uno o più campi non sono compilati correttamente</p>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product) }}" method="POST" class="row g-3"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')


            {{-- Nome prodotto --}}
            <div class="col-md-6">
                <label for="name" class="form-label">Nome prodotto *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $product->name) }}" required minlength="3" maxlength="254">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>


            {{-- Prezzo prodotto --}}
            <div class="col-6 col-md-3">
                <label for="price" class="form-label">Prezzo *</label>
                <input type="number" step=0.01 min=0 class="form-control @error('price') is-invalid @enderror"
                    id="price" name="price" value="{{ old('price', $product->price) }}" required max="999.99">
                @error('price')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>


            {{-- Ingredienti prodotto --}}
            <div class="col-12">
                <label for="ingredients" class="form-label my-2 @error('ingredients') is-invalid @enderror">Ingredienti
                    *</label>
                <textarea class="form-control" id="ingredients" placeholder="Lista Ingredienti" name="ingredients" required
                    minlength="8">{{ old('ingredients', $product->ingredients) }}</textarea>
                @error('ingredients')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>


            {{-- Immagine prodotto --}}
            <div class="col-12 col-lg-9 col-xl-10 pt-lg-1">
                <label for="image" class="form-label">Immagine</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                    name="image" value="{{ old('image', $product?->image) }}" onchange="showImage(event)">
            </div>


            {{-- Anteprima prodotto --}}
            <div class="col-12 col-lg-3 col-xl-2 pt-lg-2">
                <img id="thumb" style="width:150px; height:100px; object-fit:cover; border-radius:30px;"
                    onerror="this.src='/img/placeholder-image.jpg'" src="{{ asset('storage/' . $product?->image) }}"
                    alt="{{ $product->image_original_name }}" title="{{ $product->image_original_name }}" />
            </div>


            {{-- Categoria prodotto --}}
            <div class="col-md-8">
                <label for="category_id" class="form-label">Categoria *</label>
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


            {{-- Visibile - Vegano prodotto --}}
            <div class="d-flex gap-4 py-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_visible" name="is_visible" value="1"
                        @checked(old('is_visible', $product->is_visible))>
                    <label class="form-check-label" for="is_visible">
                        Visibile
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_vegan" name="is_vegan" value="1"
                        @checked(old('is_vegan', $product->is_vegan))>
                    <label class="form-check-label" for="is_vegan">
                        Vegano
                    </label>
                </div>
            </div>

            <span style="font-size: 0.8rem">* : campo obbligatorio;</span>


            {{-- Bottoni prodotto --}}
            <div class="col-12 py-1 py-md-3 ">
                <button type="submit" class="btn" style="background-color: #a73922; color: white">Modifica</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary ms-3">Annulla</a>
            </div>
        </form>

    </div>

    <script>
        function showImage(event) {
            const thumb = document.getElementById('thumb');
            thumb.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
