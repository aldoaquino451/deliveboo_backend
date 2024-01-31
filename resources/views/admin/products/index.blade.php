@extends('layouts.admin')

@section('content')

    <h2 class="mb-3 text-capitalize text-center fw-bold">Gestione Prodotti</h2>
    <p class="text-center">Qui potrai visualizzare e modificare i prodotti del tuo ristorante!</p>

    @if (session('success'))
        <div class="container d-flex justify-content-center">
            <div class="alert alert-success text-center" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if ($products->count() > 0)
        <div class="container d-flex flex-wrap justify-content-center">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">

                @foreach ($products as $product)
                    <div class="col">

                        <div class="card d-inline-block mb-4">

                            <p class="card-title">{{ $product->name }}</p>
                            <span class="card-price">&euro;{{ $product->price }}</span>
                            <p class="card-text">{{ $product->ingredients }}</p>
                            <ul>
                                <li class="list-group-item">
                                    @if ($product->is_visible)
                                        <i class="fa-solid fa-eye" style="color: grey;"></i>
                                    @endif
                                </li>
                                <li class="list-group-item mt-2">
                                    @if ($product->is_vegan)
                                        <i class="fa-solid fa-seedling" style="color: green;"></i>
                                    @endif
                                </li>
                            </ul>
                            <div class="action-product d-flex">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="btn btn-warning btn-edit me-2">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <button class="btn btn-trash" data-toggle="modal"
                                    data-target="#deleteModal{{ $product->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>

                        </div>

                        <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content my-modal-content py-4 px-4">
                                    <div class="d-flex justify-content-center mb-3">
                                        <i class="fa-solid fa-triangle-exclamation fs-1" style="color: #a73922"></i>
                                    </div>
                                    <div>
                                        <p class="mb-2 text-center">Sei sicuro di eliminare questo prodotto dal tuo
                                            ristorante?
                                        </p>
                                        <p class="text-center fw-bold">{{ $product->name }}</p>
                                    </div>
                                    <div class="d-flex justify-content-center gap-3">
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn"
                                                style="background-color: #a73922; color: white">Conferma</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    @else
        <p class=" text-center">Non ci sono prodotti!</p>
    @endif

    <ul class="wrapper">
        <a href="{{ route('admin.products.create') }}">
            <li class="icon new_product">
                <p class="tooltip">Aggiungi</p>
                <span><i class="fa-solid fa-circle-plus"></i></span>
            </li>
        </a>
    </ul>

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
