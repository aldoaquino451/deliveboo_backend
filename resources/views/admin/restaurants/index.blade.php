@extends('layouts.admin')

@section('content')
    <div class="container">
    <h1 class="mb-3 text-center logo">{{$restaurant->name_restaurant}}</h1>

    <div class="px-lg-5 d-flex flex-column flex-lg-row justify-content-center align-items-center">

        <div class="container-fluid">
            <div class="row d-flex mb-2">
                <strong class="col-4 col-md col-lg-3 pe-1 text-end">Indirizzo: </strong>
                <span class="col-8 col-md">{{ $restaurant->address }}</span>
            </div>
            <div class="row d-flex mb-2">
                <strong class="col-4 col-md col-lg-3 pe-1 text-end">Descrizione: </strong>
                <span class="col-8 col-md">{{ $restaurant->description }}</span>
            </div>
            <div class="row d-flex mb-2">
                <strong class="col-4 col-md col-lg-3 pe-1 text-end">Email:</strong>
                <span class="col-8 col-md">{{ $restaurant->user->email }}</span>
            </div>
            <div class="row d-flex mb-2">
                <strong class="col-4 col-md col-lg-3 pe-1 text-end">Partita IVA: </strong>
                <span class="col-8 col-md">{{ $restaurant->vat_number }}</span>
            </div>

            <div class="row d-flex mb-2">
                <strong class="col-4 col-md col-lg-3 pe-1 text-end">Tipologie: </strong>
                <div class="col-8 col-md">
                    @foreach ($restaurant->typologies as $typology)
                        <span style="background-color: #a73922" class="badge bg-cst" class="ms-2">{{ $typology->name }}</span>
                    @endforeach

                </div>
            </div>
        </div>

        <div style="max-width: 100%" class="ms-lg-5 mt-3 mt-lg-0">
            <img style="width: 100%" src="{{ $restaurant->image }}" alt="{{ $restaurant->image_original_name }}">
        </div>
    </div>


        <table style="max-width: 1000px" class="table table-striped table-hover mt-3 mx-auto shadow rounded">
            <thead>
                <tr class="text-center">
                    <th scope="col" class="col-5 col-md-2">Numero Ordine</th>
                    <th scope="col" class="d-none d-md-table-cell col-md-2">Cliente</th>
                    <th scope="col" colspan="2" class="d-none d-md-table-cell col-md-2">Indirizzo di consegna</th>
                    <th scope="col" class="col-5 col-md-2">Data</th>
                    <th scope="col" class="d-none d-md-table-cell col-md-2">Spesa Totale</th>
                    <th scope="col" class="col-2 col-md-2">Azioni</th>

                </tr>
            </thead>
            <tbody>
                </tr>
                @foreach ($orders as $order)
                    <tr class="text-center">
                        <th>#{{ $order->order_number }}</th>
                        <td class="d-none d-md-table-cell">{{ $order->name }} {{ $order->lastname }}</td>
                        <td class="d-none d-md-table-cell" colspan="2">{{ $order->address }}</td>
                        <td>{{ $order->formatted_created_at }}</td>
                        <td class="d-none d-md-table-cell">&euro; {{ $order->total_price }}</td>
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
