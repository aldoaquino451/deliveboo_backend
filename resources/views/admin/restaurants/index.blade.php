@extends('layouts.admin')

@section('content')
    <div class="container">
        @if ($restaurant)
            <div>
                <h1>{{ $restaurant->name }}</h1>
                <p>Email: <span class="ms-3">{{ $restaurant->email }}</span></p>
                <p>Indirizzo: <span class="ms-3">{{ $restaurant->address }}</span></p>
                <p>Partita IVA: <span class="ms-3">{{ $restaurant->vat_number }}</span></p>
                <p>Descrizione: <span class="ms-3">{{ $restaurant->description }}</span></p>

                <p>Crea un nuovo prodotto:</p>
                <a class="btn btn-primary" href="{{ route('admin.products.create') }}">Crea prodotto</a>
            </div>
        @else
            <div>
                <p>Aggiungi il tuo ristorante</p>
                <a class="btn btn-primary" href="{{ route('admin.create') }}">Crea</a>

            </div>
        @endif
    </div>
@endsection
