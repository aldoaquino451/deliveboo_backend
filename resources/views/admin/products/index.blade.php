@extends('layouts.admin')

@section('content')
<div class="container">

    <h1>Prodotti</h1>

    @if ($products)
        <p>Crea un nuovo prodotto:</p>
        <a class="btn btn-primary" href="{{ route('admin.products.create') }}"><i class="fa-solid fa-plus"></i></a>

        @if ($products->count() > 0)
            <table class="table">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ingredienti</th>
                    <th>Prezzo</th>
                    <th>Azioni</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->ingredients }}</td>
                            <td>{{ $product->price }} €</td>
                            <td>
                                <a class="card-link btn btn-success d-inline-block" href="{{ route('admin.products.show', $product) }}"><i class="fa-solid fa-eye"></i></a>

                                <a class="card-link btn btn-warning d-inline-block" href="{{ route('admin.products.edit', $product) }}"><i class="fa-solid fa-pen-to-square"></i></a>

                                @include('admin.partials.btnDelete', [
                                    'route' => route('admin.products.destroy', $product),
                                    'message' => 'Sei sicuro di voler eliminare questo prodotto?'
                                    ])
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @endif

    @else

            <p>Devi creare prima il ristorante!</p>

    @endif

</div>

@endsection
