@extends('layouts.admin')

@section('content')
    <h3 class="mb-4 text-capitalize text-center">Dettagli Prodotto</h3>

    <div class="my-3 mx-5 p-3 card">

        <h4 class="mb-3">{{ $product->name }}</h4>

        <p class="mb-2">
            <strong>Ingredienti: </strong>
            <span class="ms-2">{{ $product->ingredients }}</span>
        </p>
        <p class="mb-2">
            <strong>Prezzo: </strong>
            <span class="ms-2">&euro; {{ $product->price }}</span>
        </p>
        @if ($product->is_vegan)
            <p class="mb-2 text-success">
                <strong>Prodotto Vegano</strong>
            </p>
        @endif

    </div>
@endsection
