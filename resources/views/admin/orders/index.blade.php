@extends('layouts.admin')

@section('content')
    {{-- <h1>{{ $monthlyTotal }}</h1> --}}
    <h2 class="mb-3 text-capitalize text-center fw-bold">Gestione Ordini</h2>
    <p class="text-center">Qui potrai visualizzare tutti li ordini ricevuti!</p>

    <table class="table table-striped table-hover">
        <thead>
            <tr class="text-center">
                <th scope="col">Numero Ordine</th>
                <th scope="col">Cliente</th>
                <th scope="col" colspan="2">Indirizzo di consegna</th>
                <th scope="col">Data</th>
                <th scope="col">Spesa Totale</th>
                <th scope="col">Azioni</th>

            </tr>
        </thead>
        <tbody>
            </tr>
            @foreach ($orders_list as $order)
                <tr class="text-center">
                    <th>#{{ $order->order_number }}</th>
                    <td>{{ $order->name }} {{ $order->lastname }}</td>
                    <td colspan="2">{{ $order->address }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>&euro; {{ $order->total_price }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order ) }}" class="card-link btn btn-success d-inline-block"><i
                                class="fa-regular fa-eye"></i></a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <script>



    </script>
@endsection
