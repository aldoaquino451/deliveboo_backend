@extends('layouts.admin')

@section('content')
    <h2 class="mb-3 text-capitalizte text-center">Lista Prodotti</h2>

    {{-- <div class="my-4 d-flex justify-content-center">
        <a class="btn-fr" href="{{ route('admin.products.create') }}">
            <div class="btn-message d-flex align-items-center gap-2 p-2">
                <span class="message text-uppercase">Crea prodotto</span>
                <i class="fa-solid fa-circle-plus"></i>
            </div>
        </a>
    </div> --}}

    @if (session('success'))
        <div class="container d-flex justify-content-center">
            <div class="alert alert-success text-center" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif


    <ul class="wrapper">
        <a href="{{ route('admin.products.create') }}">
            <li class="icon new_product">
                <p class="tooltip">Aggiungi</p>
                <span><i class="fa-solid fa-circle-plus"></i></span>
            </li>
        </a>
    </ul>


    @if ($products->count() > 0)
        <div class="container d-flex flex-wrap justify-content-center" style="flex-wrap: flex-start;">
            @foreach ($products as $product)
                <a class="product-card d-inline-block text-decoration-none"
                    href="{{ route('admin.products.edit', $product) }}">
                    <div class="card my-3 mx-3" style="width: 18rem; min-height: 18rem;">
                        {{-- <img src="..." class="card-img-top" alt="..."> --}}
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <h5 class="card-title">&euro;{{ $product->price }}</h5>
                            <p class="card-text">{{ $product->ingredients }}</p>
                            @if ($product->is_vegan === 1)
                                <p class="mb-2 fw-bold text-success">Prodotto Vegano</p>
                            @endif
                            @if ($product->is_visible === 1)
                                <p class="mb-2 fw-bold text-warning">E' visibile</p>
                            @endif
                            <div class="button-trash d-flex justify-content-end align-items-end">
                                <button class="btn btn-danger delete-btn" data-toggle="modal"
                                    data-target="#deleteModal{{ $product->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </a>

                <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content my-modal-content py-4 px-4">
                            <div class="d-flex justify-content-center mb-3">
                                <i class="fa-solid fa-triangle-exclamation fs-1 text-danger"></i>
                            </div>
                            <div>
                                <p class="mb-2 text-center">Sei sicuro di eliminare questo prodotto dal tuo ristorante?
                                </p>
                                <p class="text-center fw-bold">{{ $product->name }}</p>
                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Conferma</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class=" text-center">Non ci sono prodotti!</p>
    @endif

@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // apri il layout della delete modal
            $('.delete-btn').click(function() {
                var productId = $(this).data('product-id');
                $('#deleteModal' + productId).modal('show');
            });

            // previene l'evento che porta all'edit del prodotto
            var deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                });
            });
        });
    </script>
@endsection
