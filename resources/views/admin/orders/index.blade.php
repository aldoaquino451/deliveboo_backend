@extends('layouts.admin')

@section('content')
    {{-- <h1>{{ $monthlyTotal }}</h1> --}}
    <h2 class="mb-3 text-capitalize text-center fw-bold">Ordini</h2>
    <div class="container">

        <table class="table table-striped table-hover">
            <thead>
                <tr class="text-center">
                    <th scope="col">Ordine n°</th>
                    <th class="lg-visible" scope="col">Cliente</th>
                    <th class="md-visible" scope="col" colspan="2">Indirizzo</th>
                    <th scope="col">Data</th>
                    <th class="lg-visible" scope="col">Spesa Totale</th>
                    <th scope="col">Azioni</th>

                </tr>
            </thead>
            <tbody>
                </tr>
                @foreach ($orders_list as $order)
                    <tr class="text-center">
                        <th>#{{ $order->order_number }}</th>
                        <td class="lg-visible">{{ $order->name }} {{ $order->lastname }}</td>
                        <td class="md-visible" colspan="2">{{ $order->address }}</td>
                        <td class="">{{ $order->formatted_created_at }}</td>
                        <td class="lg-visible">&euro; {{ $order->total_price }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}"
                                class="card-link btn btn-secondary d-inline-block"><i class="fa-regular fa-eye"></i></a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
