@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>{{ $restaurant->name }}</h1>

        <p>Crea un nuovo prodotto:</p>
        <a class="btn btn-primary" href="{{ route('admin.products.create') }}">Crea prodotto</a>
    </div>
@endsection
