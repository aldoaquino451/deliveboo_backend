@extends('layouts.admin')

@section('content')
    <h2 class="mb-3 text-capitalize text-center">dashboard</h2>
    <P class="text-center">Qui potrai visualizzare tutte le statistiche e i grafici degli ordini!</P>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Numero Ordine</th>
                <th scope="col">Data</th>
                <th scope="col">Prodotti</th>
                <th scope="col">Prezzo</th>
                <th scope="col">Quantità</th>
                <th scope="col">Spesa Totale</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <th>{{ $order->order_number }}</th>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        <ul class=" list-unstyled">
                            @foreach ($order->products as $product)
                                <li>{{ $product->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul class=" list-unstyled">
                            @foreach ($order->products as $product)
                                <li>&euro; {{ $product->price }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul class=" list-unstyled">
                            @foreach ($order->products as $product)
                                <li>{{ $product->pivot->quantity }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>&euro; {{ $order->total_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
