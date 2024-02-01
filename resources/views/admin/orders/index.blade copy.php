@extends('layouts.admin')

@section('content')
    <h2 class="mb-3 text-capitalize text-center fw-bold">Ordini</h2>
    <div class="container">

        <table class="table table-hover">
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
                @foreach ($orders_list as $order)
                    <tr class="text-center">
                        <th>#{{ $order->order_number }}</th>
                        <td class="lg-visible">{{ $order->name }} {{ $order->lastname }}</td>
                        <td class="md-visible" colspan="2">{{ $order->address }}</td>
                        <td class="">{{ $order->formatted_created_at }}</td>
                        <td class="lg-visible">&euro; {{ $order->total_price }}</td>
                        <td>
                            <button onclick="toggleOrder('{{ $order->order_number }}')"
                                class="card-link btn btn-secondary d-inline-block"><i
                                    class="fa-regular fa-eye"></i></button>
                        </td>

                    </tr>

                    <div class="modal d-none fade" id="deleteModal{{ $order->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content my-modal-content py-4 px-4">
                                @foreach ($order_watch->products as $product)
                                    <div class="products_{{ $order->order_number }}">
                                        <ul>
                                            <li>
                                                <span>{{ $product->pivot->quantity }}</span>
                                            </li>
                                            <li>
                                                <span>{{ $product->name }}</span>
                                            </li>
                                            <li>
                                                <span>&euro; {{ $product->price }}</span>
                                            </li>
                                            <li>
                                                <span>&euro;
                                                    {{ number_format($product->pivot->quantity * $product->price, 2) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                                @endforeach

                            </div>
                        </div>
                    </div>


                    @foreach ($order->products as $product)
                        <div class="d-none products_{{ $order_watch->order_number }}">
                            <ul>
                                <li>
                                    <span>{{ $product->pivot->quantity }}</span>
                                </li>
                                <li>
                                    <span>{{ $product->name }}</span>
                                </li>
                                <li>
                                    <span>&euro; {{ $product->price }}</span>
                                </li>
                                <li>
                                    <span>&euro;
                                        {{ number_format($product->pivot->quantity * $product->price, 2) }}</span>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        {{ $orders_list->links() }}
    </div>

    <script>
        function toggleOrder(orderNumber) {
            const classtr = `.products_${orderNumber}`;
            $(classtr).toggleClass('d-none');
        }
    </script>
@endsection
