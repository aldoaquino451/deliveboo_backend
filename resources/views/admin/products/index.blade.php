@extends('layouts.admin')

@section('content')
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
            <a class="product-card d-inline-block text-decoration-none" href="{{ route('admin.products.edit', $product) }}">
                <div class="card my-3 mx-3" style="width: 18rem; height: 18rem;">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <h5 class="card-title">&euro;{{ $product->price }}</h5>
                        <p class="card-text">{{ $product->ingredients }}</p>
                        <div class="d-flex justify-content-end">
                            @include('admin.partials.btnDelete', [
                                'route' => route('admin.products.destroy', $product),
                                'message' => 'Sei sicuro di voler eliminare questo prodotto?',
                            ])
                        </div>
                    </div>
                </div>
            </a>
            @endforeach

                {{-- <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Ingredienti</th>
                            <th style="min-width: 80px">Prezzo</th>
                            <th style="min-width: 160px">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->ingredients }}</td>
                                <td>&euro; {{ $product->price }}</td>
                                <td>
                                    <a class="card-link btn btn-success d-inline-block"
                                        href="{{ route('admin.products.show', $product) }}"><i class="fa-solid fa-eye"></i></a>

                                    <a class="card-link btn btn-warning d-inline-block"
                                        href="{{ route('admin.products.edit', $product) }}"><i
                                            class="fa-solid fa-pen-to-square"></i></a>

                                    @include('admin.partials.btnDelete', [
                                        'route' => route('admin.products.destroy', $product),
                                        'message' => 'Sei sicuro di voler eliminare questo prodotto?',
                                    ])
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table> --}}
            @endif
        </div>
    @endif


@endsection
