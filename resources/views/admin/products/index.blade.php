@extends('layouts.admin')

@section('content')
    @if ($productToDelete)
        <div id="delete-modal-container" class="d-flex justify-content-center align-items-center">
            <div class="delete-modal d-flex flex-column align-items-center">
                <i class="fa-solid fa-triangle-exclamation fs-1 text-danger"></i>
                <p class="my-3 text-center">Sei sicuro di eliminare questo prodotto dal tuo ristorante?</p>
                <div class="d-flex gap-3">
                    <form class="d-inline-block" action="{{ route('admin.products.destroy', $productToDelete) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Conferma</i>
                        </button>
                    </form>
                    <a class="btn btn-secondary" href="{{ route('admin.products.index') }}">
                        Annulla
                    </a>
                </div>
            </div>
        </div>
    @endif


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

        @if (session('success'))
            <div class="container d-flex justify-content-center">
                <div class="alert alert-success text-center" role="alert">
                    {{ session('success') }}
                </div>
            </div>
        @endif


        @if ($products->count() > 0)
            <div class="container d-flex flex-wrap justify-content-center">
                @foreach ($products as $product)
                    <a class="product-card d-inline-block text-decoration-none"
                        href="{{ route('admin.products.edit', $product) }}">
                        <div class="card my-3 mx-3" style="width: 18rem; height: 18rem;">
                            {{-- <img src="..." class="card-img-top" alt="..."> --}}
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <h5 class="card-title">&euro;{{ $product->price }}</h5>
                                <p class="card-text">{{ $product->ingredients }}</p>
                                @if ($product->is_vegan === 1)
                                    <p class="mb-2 fw-bold text-success">Prodotto Vegano</p>
                                @endif
                                @if ($product->is_visible === 1)
                                    <p class="mb-2 fw-bold text-warning">E' visibile</p>
                                @endif
                                <div class="button-position">
                                    <form action="{{ route('admin.products-new', $product) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <p class=" text-center">Non ci sono prodotti!</p>
        @endif
    @endif


    {{-- <script>
        const deleteModal = document.getElementById('delete-modal-container');
        deleteModal.classList.add('d-none');

        function addDeleteModal() {
            deleteModal.classList.add('d-none');
            console.log('ciao');
        }

        function removeDeleteModal() {
            deleteModal.classList.remove('d-none');
            console.log('ciao');
        }
    </script> --}}
@endsection
