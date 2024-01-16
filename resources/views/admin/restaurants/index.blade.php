@extends('layouts.admin')

@section('content')
    <h1 class="mb-3 text-capitalize text-center">Home</h1>

    @if ($restaurant)
        <div class="px-5">
            <h3 class="mb-3 text-capitalize">{{ $restaurant->name }}</h3>
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
                <span class="ms-2">{{ $restaurant->email }}</span>
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


            {{-- 
            <div class="mt-5">
                <a class="p-0 btn btn-primary fs-2" href="{{ route('admin.products.create') }}">
                    <div class="py-0 px-2 btn btn-primary d-flex align-items-center gap-3">
                        <span>Crea un nuovo prodotto</span>
                        <span class=" fs-2">
                            <i class="fa-solid fa-circle-plus"></i>
                        </span>
                    </div>
                </a>
            </div> 
            --}}
        </div>
    @else
        <div class="d-flex justify-content-center">
            <a class="p-0 btn btn-primary fs-2" href="{{ route('admin.create') }}">
                <div class="btn btn-primary d-flex align-items-center gap-3">
                    <span>Aggiungi il tuo ristorante</span>
                    <span class=" fs-2">
                        <i class="fa-solid fa-circle-plus"></i>
                    </span>
                </div>
            </a>
        </div>
    @endif
@endsection
