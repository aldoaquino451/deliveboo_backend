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
                                <p>Uno o più campi non sono compilati correttamente</p>
                            </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}
                                    (*)</label>
                                <div class="col-md-8">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required minlength="3" autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}
                                    (*)</label>
                                <div class="col-md-8">
                                    <input id="lastname" type="text"
                                        class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                        value="{{ old('lastname') }}" required minlength="3" autocomplete="lastname"
                                        autofocus>
                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}
                                    (*)</label>
                                <div class="col-md-8">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email"
                                        onfocus="hideEmailMessage()">
                                    @error('email')
                                        <span id="email-message" class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}
                                    (*)</label>
                                <div class="col-md-8">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required minlength="8" maxlength="32" autocomplete="off" not-enter not-space>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }} (*)</label>
                                <div class="col-md-8">
                                    <input id="password-confirm" type="password"
                                        class="form-control @error('password-confirm') is-invalid @enderror"
                                        name="password_confirmation" required minlength="8" maxlength="32" not-enter
                                        not-space autocomplete="off" onblur="validatePassword()">
                                    <p id="message-password"></p>
                                </div>
                            </div>
                            <h5 class="text-center my-3">Dati relativi al ristorante</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name_restaurant">Nome ristorante (*)</label>
                                    <input type="text"
                                        class="form-control @error('name_restaurant') is-invalid @enderror"
                                        id="name_restaurant" required name="name_restaurant"
                                        value="{{ old('name_restaurant') }}">
                                    @error('name_restaurant')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="vat_number">Partita IVA (*)</label>
                                    <input type="text" class="form-control @error('vat_number') is-invalid @enderror"
                                        id="vat_number" required minlength="11" maxlength="11" name="vat_number"
                                        value="{{ old('vat_number') }}" onfocus="hideVatNumberMessage()">
                                    @error('vat_number')
                                        <span id="vat-number-message" class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Indirizzo (*)</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    id="address" required name="address" placeholder="Indirizzo, CAP, Città, Provincia"
                                    value="{{ old('address') }}">
                            </div>
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <div class="col-12">
                                <label for="image" class="form-label">Immagine</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="image" name="image" value="{{ old('image') }}">
                            </div>
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <div class="col-12">
                                <label for="description" class="form-label">Descrizione</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                    placeholder="Inserisci una breve descrizione" name="description" value="{{ old('description') }}"></textarea>
                            </div>
                            <span style="font-size: 0.8rem">(*) = campo obbligatorio;</span>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror


                            <div class="text-center mt-3">
                                <p>Selezione una o più tipologie per il tuo ristorante:</p>
                                <div role="group" aria-label="Small button group">
                                    @foreach ($typologies as $typology)
                                        <input type="checkbox" class="btn-check" id="typology_{{ $typology->id }}"
                                            autocomplete="off" name="typologies[]" value="{{ $typology->id }}">
                                        <label class="btn btn-outline-secondary m-1"
                                            for="typology_{{ $typology->id }}">{{ $typology->name }}</label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="my-4 row">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrati') }}
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

@section('script')
    <script>
        let timeOut;
        const emailMessage = document.getElementById('email-message');
        const vatNumberMessage = document.getElementById('vat-number-message');

        emailMessage.classList.remove('d-none');
        vatNumberMessage.classList.remove('d-none');

        function hideEmailMessage() {
            emailMessage.classList.add('d-none');
        }

        function hideVatNumberMessage() {
            vatNumberMessage.classList.add('d-none');
        }

        function validatePassword() {
            const password = document.getElementById("password").value;
            const passwordConfirm = document.getElementById("password-confirm").value;
            const messagePassword = document.getElementById("message-password");

            if (password !== passwordConfirm) {
                clearTimeout(timeOut);
                messagePassword.classList.add('text-danger');
                messagePassword.innerText = "Le password inserite sono diverse";
            } else {
                messagePassword.classList.remove('text-danger');
                messagePassword.classList.add('text-success');
                messagePassword.innerText = "Le password corrispondono!";
                timeOut = setTimeout(() => {
                    messagePassword.innerText = '';
                }, 3000);
            }
        }
    </script>
@endsection
