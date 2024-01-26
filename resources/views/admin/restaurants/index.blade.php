@extends('layouts.admin')

@section('content')
    <h1 class="mb-3 text-center">Il tuo ristorante</h1>

    <div class="px-5">
        <h3 class="mb-3 text-capitalize">{{ $restaurant->name_restaurant }}</h3>
        <p class="mb-2">
            <strong>Indirizzo: </strong>
            <span class="ms-2">{{ $restaurant->address }}</span>
        </p>
        <p class="mb-2">
            <strong>Descrizione: </strong>
            <span class="ms-2">{{ $restaurant->description }}</span>
        </p>
        <p class="mb-2">
            <strong>Email:</strong>
            <span class="ms-2">{{ $restaurant->user->email }}</span>
        </p>
        <p class="mb-2">
            <strong>Partita IVA: </strong>
            <span class="ms-2">{{ $restaurant->vat_number }}</span>
        </p>
        <p class="mb-2">
            <strong>Tipologie: </strong>
            @foreach ($restaurant->typologies as $typology)
                <span class="badge bg-info" class="ms-2">{{ $typology->name }}</span>
            @endforeach
        </p>
        <p class="mb-2">
        <p><strong>Immagine del ristorante:</strong></p>
        <img src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->image_original_name }}">
        </p>
    </div>
@endsection
