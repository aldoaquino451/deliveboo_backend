@extends('layouts.admin')

@section('content')
    <div class="container">
    <h1 class="mb-3 text-center logo">{{$restaurant->name_restaurant}}</h1>

    <div class="px-md-5 d-flex flex-column flex-md-row justify-content-center align-items-center">

        <div>
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
                <span class="ms-2">{{ $restaurant->user->email }}</span>
            </p>
            <p class="mb-2">
                <strong>Partita IVA: </strong>
                <span class="ms-2">{{ $restaurant->vat_number }}</span>
            </p>
            <p class="mb-2">
                <strong>Tipologie: </strong>
                @foreach ($restaurant->typologies as $typology)
                    <span style="background-color: #a73922" class="badge bg-cst" class="ms-2">{{ $typology->name }}</span>
                @endforeach
            </p>
        </div>

        <div style="max-width: 300px" class="ms-md-5">
            <img style="width: 100%" src="{{ $restaurant->image }}" alt="{{ $restaurant->image_original_name }}">
        </div>
    </div>


        <table style="max-width: 1000px" class="table table-striped table-hover mt-3 mx-auto">
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
                @foreach ($orders as $order)
                    <tr class="text-center">
                        <th>#{{ $order->order_number }}</th>
                        <td>{{ $order->name }} {{ $order->lastname }}</td>
                        <td colspan="2">{{ $order->address }}</td>
                        <td>{{ $order->formatted_created_at }}</td>
                        <td>&euro; {{ $order->total_price }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order ) }}" class="card-link btn btn-secondary d-inline-block"><i
                                    class="fa-regular fa-eye"></i></a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection
