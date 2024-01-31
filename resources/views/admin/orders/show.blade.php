@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row row-cols-lg-2">
            <div class="col col-lg-8 py-3 px-4">
                <h3 class="mb-4">Dettaglio ordine</h3>

                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Quantità</th>
                            <th scope="col">Prodotto</th>
                            <th scope="col">Prezzo</th>
                            <th scope="col">Totale</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr class="text-center">
                            <td>{{ $product->pivot->quantity }}</td>
                            <td>{{ $product->name }}</td>
                            <td>&euro; {{ $product->price }}</td>
                            <td>&euro; {{ number_format($product->pivot->quantity * $product->price, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th></th>
                        <th></th>
                        <th class="text-end">Totale:</th>
                        <th class="text-center">&euro; {{$order->total_price}}</th>
                    </tfoot>
                </table>
            </div>

            <div class="col col-lg-4 py-3 px-4">
                <h3 class="mb-4">Dettagli consegna:</h3>
                <p>Nome: <strong class="ms-3">{{$order->name}}</strong></p>
                <p>Cognome: <strong class="ms-3">{{$order->lastname}}</strong></p>
                <p>Indirizzo: <strong class="ms-3">{{$order->address}}</strong></p>
                <p>Email: <strong class="ms-3">{{$order->email}}</strong></p>
                <p>Telefono: <strong class="ms-3">{{$order->phone_number}}</strong></p>
            </div>
        </div>

    </div>

@endsection
