@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registrazione</div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                {{-- <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul> --}}
                                <p>Uno o più campi non sono compilati correttamente</p>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-8">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="lastname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Lastname') }}</label>
                                <div class="col-md-8">
                                    <input id="lastname" type="text"
                                        class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                        value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                                <div class="col-md-8">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-8">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <h4>Dati relativi al ristorante:</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name_restaurant">Nome ristorante</label>
                                    <input type="text"
                                        class="form-control @error('name_restaurant') is-invalid @enderror"
                                        id="name_restaurant" name="name_restaurant" value="{{ old('name_restaurant') }}">
                                    @error('name_restaurant')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="vat_number">Partita IVA</label>
                                    <input type="text" class="form-control @error('vat_number') is-invalid @enderror"
                                        id="vat_number" name="vat_number" value="{{ old('vat_number') }}">
                                    @error('vat_number')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Indirizzo</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    id="address" name="address" placeholder="indirizzo, CAP, Città(Prov)"
                                    value="{{ old('address') }}">
                            </div>
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- <div class="col-12">
                                <label for="image" class="form-label">Immagine</label>
                                <input id="image" class="form-control" name="image" type="file">
                            </div> --}}

                            <div class="col-12">
                                <label for="description" class="form-label">Descrizione</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                    placeholder="Inserisci una breve descrizione" name="description" value="{{ old('description') }}"></textarea>
                            </div>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror


                            <div class="text-center mt-3">
                                <p>Selezione una o più tipologie per il tuo ristorante:</p>
                                <div class="btn" role="group" aria-label="Small button group">
                                    @foreach ($typologies as $typology)
                                        <input type="checkbox" class="btn-check" id="typology_{{ $typology->id }}"
                                            autocomplete="off" name="typologies[]" value="{{ $typology->id }}">
                                        <label class="btn btn-outline-primary m-1"
                                            for="typology_{{ $typology->id }}">{{ $typology->name }}</label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-4 row mb-0">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
