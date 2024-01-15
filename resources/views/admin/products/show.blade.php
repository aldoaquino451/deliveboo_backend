@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->ingredients }}</p>
    <p>{{ $product->price }}</p>
    @if ($product->is_vegan) <span>Prodotto Vegano</span> @endif

</div>
@endsection
