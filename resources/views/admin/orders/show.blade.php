@extends('layouts.admin')

@section('content')
    <div class="container-fluid container-lg" style="max-width: 800px ">

        <h2 class="text-center fw-bold py-4">Ordine: #{{ $order->order_number }}</h2>

        <div class="row mb-5">
            <div class="col-md-3">
                <h4 class="mb-4 fw-bold ">Consegna:</h4>
            </div>
            <div class="col-md-9">
                <p class="mb-2 fw-light">Nome: <strong class="ms-3 text-capitalize fw-bold">{{ $order->name }}
                        {{ $order->lastname }}</strong></p>
                <p class="mb-2 fw-light">Indirizzo: <strong
                        class="ms-3 text-capitalize fw-bold">{{ $order->address }}</strong></p>
                <p class="mb-2 fw-light">Email: <strong class="ms-3 fw-bold">{{ $order->email }}</strong></p>
                <p class="mb-2 fw-light">Telefono: <strong class="ms-3 fw-bold">{{ $order->phone_number }}</strong>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-3">
                <h4 class="mb-4 fw-bold ">Prodotti:</h4>
            </div>
            <div class="col-12 col-md-9">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Prodotto</th>
                            <th scope="col" style="width: 100px">Quantità</th>
                            <th scope="col" style="width: 100px">Prezzo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="text-center">
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>&euro; {{ $product->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th></th>
                        <th class="text-end">Totale:</th>
                        <th class="text-center">&euro; {{ $order->total_price }}</th>
                    </tfoot>
                </table>

            </div>
        </div>

    </div>
@endsection
