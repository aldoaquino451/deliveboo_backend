@extends('layouts.admin')
@section('content')
    <div class="container px-5 py-3">

        <h4 class="mb-4">Inserisci i dati del nuovo prodotto</h4>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <p>Uno o più campi non sono compilati correttamente</p>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf

            <div class="col-md-6">
                <label for="name" class="form-label">Nome prodotto (*)</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    autocomplete="name" autofocus required minlength="3" maxlength="254" value="{{ old('name') }}">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-md-2">
                <label for="price" class="form-label">Prezzo (*)</label>
                <input type="number" step=0.01 min=0 max=999.99 required
                    class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                    value="{{ old('price') }}">
                @error('price')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-12">
                <label for="ingredients" class="form-label @error('ingredients') is-invalid @enderror">Ingredienti
                    (*)</label>
                <textarea class="form-control" id="ingredients" placeholder="Lista Ingredienti" name="ingredients" required
                    minlength="8">{{ old('ingredients') }}</textarea>
                @error('ingredients')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-12 col-lg-10">
                <label for="image" class="form-label">Immagine</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                    name="image" value="{{ old('image') }}" onchange="showImage(event)">
            </div>
            @error('image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <img id="thumb" style="width:150px; border-radius:30px;" class="d-none d-lg-block"
                src="/img/placeholder-image.jpg" />


            <div class="col-md-8">
                <label for="category_id" class="form-label">Categoria (*)</label>
                <select id="category_id" class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                    <option value=0 selected>Seleziona</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach

                </select>
                @error('category_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-md-12 ">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="is_visible" name="is_visible" value="1"
                        {{ old('is_visible') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_visible">
                        Visibile
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_vegan" name="is_vegan" value="1"
                        {{ old('is_vegan') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_vegan">
                        Vegano
                    </label>
                </div>
            </div>

            <span style="font-size: 0.8rem">(*) = campo obbligatorio;</span>

            <div class="col-12 mt-4 text-center">
                <button type="submit" class="btn me-3" style="background-color: #a73922; color: white">Crea</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Annulla</a>
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
