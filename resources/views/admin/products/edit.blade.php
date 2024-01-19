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

            <div class="col-10">
                <label for="image" class="form-label">Immagine</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                    name="image" value="{{ old('image', $product?->image) }}" onchange="showImage(event)">
            </div>
            @error('address')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="col-2">
                <img id="thumb" class="img-fluid" style="border-radius:30px;"
                    onerror="this.src='/img/placeholder-image.jpg'" src="{{ asset('storage/' . $product?->image) }}"
                    alt="{{ $product->image_original_name }}" title="{{ $product->image_original_name }}" />
            </div>


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

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary">Modifica</button>
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
