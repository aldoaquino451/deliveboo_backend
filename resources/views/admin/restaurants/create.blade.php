@extends('layouts.admin')

@section('content')
    <div class="py-4 px-5">

        <h3 class="mb-4">Inserisci i dati del tuo nuovo ristorante</h3>

        <form action="{{ route('admin.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf

            <div class="col-md-6">
                <label for="name" class="form-label">Nome ristorante</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="col-12">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" class="form-control" id="address" name="address"
                    placeholder="indirizzo, CAP, Città(Prov)">
            </div>

            <div class="col-md-8">
                <label for="vat_number" class="form-label">Partita IVA</label>
                <input type="text" class="form-control" id="vat_number" name="vat_number">
            </div>

            <div class="col-12">
                <label for="image" class="form-label">Immagine</label>
                <input id="image" class="form-control" name="image" type="file">
            </div>

            <div class="col-12">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" id="description" placeholder="Inserisci una breve descrizione" name="description"></textarea>
            </div>

            <div class="col-12">
                <div class="btn-group btn-group-sm my-2" role="group" aria-label="Small button group">
                    @foreach ($typologies as $typology)
                        <input type="checkbox" class="btn-check" id="typology_{{ $typology->id }}" autocomplete="off"
                            name="typologies[]" value="{{ $typology->id }}">
                        <label class="btn btn-outline-primary"
                            for="typology_{{ $typology->id }}">{{ $typology->name }}</label>
                    @endforeach
                </div>
            </div>

            <div class="col-12 ">
                <button type="submit" class="my-3 btn btn-primary">Crea</button>
                <button type="reset" class="my-3 btn btn-secondary">Annulla</button>
            </div>
        </form>

    </div>
@endsection
