@extends('layouts.admin')

@section('content')

    <div id="delete-modal-container" class="d-flex justify-content-center align-items-center">
        <div class="delete-modal d-flex flex-column align-items-center">
            <i class="fa-solid fa-triangle-exclamation fs-1 text-danger"></i>
            <p class="my-3 text-center">Sei sicuro di eliminare questo prodotto dal tuo ristorante?</p>
            {{-- <p>{{ $productToDelete }}</p> --}}
            <div class="">
                <button class="me-2 btn btn-danger">
                    {{-- @include('admin.partials.btnDelete', [
                        'route' => route('admin.products.destroy', $product),
                        'message' => 'Sei sicuro di voler eliminare questo prodotto?',
                    ]) --}}
                </button>
                <button onclick="toggleDeleteModal()" class="btn btn-secondary">Annulla</button>
            </div>
        </div>
    </div>


    <h2 class="mb-3 text-capitalize text-center">Lista Prodotti</h2>

    @if (!$products)
        <p class="text-center">Devi creare prima il ristorante!</p>
    @else
        <div class="my-4 d-flex justify-content-center">
            <a class="p-0 btn btn-primary fs-2" href="{{ route('admin.products.create') }}">
                <div class="py-0 px-2 btn btn-primary d-flex align-items-center gap-3">
                    <span>Crea un nuovo prodotto</span>
                    <span class=" fs-2">
                        <i class="fa-solid fa-circle-plus"></i>
                    </span>
                </div>
            </a>
        </div>

        <div class="container d-flex flex-wrap justify-content-center">
            @if ($products->count() > 0)
                @foreach ($products as $product)
                    {{-- <a class="product-card d-inline-block text-decoration-none"
                        href="{{ route('admin.products.edit', $product) }}"> --}}
                    <div class="card my-3 mx-3" style="width: 18rem; height: 18rem;">
                        {{-- <img src="..." class="card-img-top" alt="..."> --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <h5 class="card-title">&euro;{{ $product->price }}</h5>
                            <p class="card-text">{{ $product->ingredients }}</p>
                            @if ($product->is_vegan)
                                <p class="mb-2 fw-bold text-success">Prodotto Vegano</p>
                            @endif
                            @if ($product->is_visible)
                                <p class="mb-2 fw-bold text-warning">E' visibile</p>
                            @endif
                            <button onclick="toggleDeleteModal($product->name)" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    {{-- </a> --}}
                @endforeach
            @endif
        </div>
    @endif


    <script>
        const deleteModal = document.getElementById('delete-modal-container');
        deleteModal.classList.add('d-none');

        function toggleDeleteModal(name) {
            deleteModal.classList.toggle('d-none');
            console.log(name);
        }
    </script>
@endsection
