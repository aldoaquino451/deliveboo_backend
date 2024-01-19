@extends('layouts.admin')

@section('content')




    {{-- <form class="d-inline-block" action="{{ route('admin.products.destroy', $productToDelete) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            Conferma</i>
        </button>
    </form> --}}

    <div class="test h-100 w-100"></div>


    <h2 class="mb-3 text-capitalize text-center">Lista Prodotti</h2>

    @if (!$products)
        <p class="text-center">Devi creare prima il ristorante!</p>
    @else
        <div class="my-4 d-flex justify-content-center">
            <a class="p-0 btn btn-primary fs-2" href="{{ route('admin.products.create') }}">
                <div class="py-0 px-2 btn btn-primary d-flex align-items-center gap-3">
                    <span>Crea un nuovo prodotto</span>
                    <span class=" fs-2">
                        <i class="fa-solid fa-circle-plus"></i>
                    </span>
                </div>
            </a>
        </div>

        @if ($products->count() > 0)
            <div class="container d-flex flex-wrap justify-content-center">
                @foreach ($products as $product)
                    {{-- <a class="product-card d-inline-block text-decoration-none"
                        href="{{ route('admin.products.edit', $product) }}"> --}}
                    <div class="card my-3 mx-3" style="width: 18rem; height: 18rem;">
                        {{-- <img src="..." class="card-img-top" alt="..."> --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <h5 class="card-title">&euro;{{ $product->price }}</h5>
                            <p class="card-text">{{ $product->ingredients }}</p>
                            @if ($product->is_vegan === 1)
                                <p class="mb-2 fw-bold text-success">Prodotto Vegano</p>
                            @endif
                            @if ($product->is_visible === 1)
                                <p class="mb-2 fw-bold text-warning">E' visibile</p>
                            @endif
                            <div class="button-position">
                                <button onclick="show({{ $product }})" type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                    {{-- </a> --}}
                @endforeach
            </div>
        @else
            <p class=" text-center">Non ci sono prodotti!</p>
        @endif
    @endif

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const test = document.querySelector(".test");
        const div = document.createElement("div");
        div.classList.add('delete-modal-container');
        test.append(div);


        function show(product) {
            console.log('ciao');
            console.log(product);
            div.classList.add('d-flex');
            div.innerHTML = `
            <div class="delete-modal d-flex flex-column align-items-center">
              <i class="fa-solid fa-triangle-exclamation fs-1 text-danger"></i>
              <p class="my-3 text-center">
                Sei sicuro di eliminare questo prodotto dal tuo ristorante?
              </p>
              <p class="text-center">product</p>
              <div class="d-flex gap-3">
                <button onclick="hide()" class="btn btn-secondary"">
                  Annulla
                </button>
              </div>
            </div>
            `;
        }

        function hide() {
            div.classList.remove('d-flex')
        }
    </script>
@endsection
