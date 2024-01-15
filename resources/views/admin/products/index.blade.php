@extends('layouts.admin')

@section('content')

    <h1>Prodotti</h1>

    <ul>
        @foreach ($products as $product)
        <li>{{ $product->name }}
            <a href="{{route('admin.products.edit', $product)}}">edit</a>
        </li>



        @endforeach
    </ul>

@endsection
