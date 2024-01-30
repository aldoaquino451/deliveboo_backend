@extends('layouts.admin')

@section('content')
    {{-- <h1>{{ $monthlyTotal }}</h1> --}}
    <h2 class="mb-3 text-capitalize text-center">dashboard</h2>
    <P class="text-center">Qui potrai visualizzare tutte le statistiche e i grafici degli ordini!</P>

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
                        <a href="#" class="card-link btn btn-success d-inline-block"><i
                                class="fa-regular fa-eye"></i></a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container-fluid">

        <div class="charts-container row row-cols-1 row-cols-lg-2">
            <div class="chart col">
                <canvas id="lineChartOrders"></canvas>
            </div>
            <div class="chart col">
                <canvas id="barChartOrders"></canvas>
            </div>
            <div class="chart col">
                <canvas id="lineChartAmount"></canvas>
            </div>
            <div class="chart col">
                <canvas id="barChartAmount"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {

            // Grafico linear per totale ordini mensile
            const resultAPI = await fetch('/admin/charts/order/month', {
                method: 'GET',
            }).then(response => response.json())

            const ctxLine = document.getElementById('lineChartOrders');
            const data = resultAPI

            new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio',
                        'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'
                    ],

                    datasets: [{
                        label: 'Ordini',
                        data: data,
                        parsing: {
                            yAxisKey: 'orders'
                        }
                    }]
                },
                options: {
                    backgroundColor: 'rgba(241, 48, 5, 0.2)',
                    borderColor: 'rgba(241, 48, 5, 1)',
                    borderWidth: 1,
                    responsive: true,
                    maintainAspectRatio: false,
                    aspectRatio: 1,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            /////////////////////////////////////////////
            /////////////////////////////////////////////
            /////////////////////////////////////////////
            /////////////////////////////////////////////
            /////////////////////////////////////////////


            // Grafico linear per totale ordini annuo
            const resultAPIyear = await fetch('/admin/charts/order/year', {
                method: 'GET',
            }).then(response => response.json())

            const ctxBar = document.getElementById('barChartOrders');

            let array_orders = [];
            for (let i = 0; i < resultAPIyear.orders.length; i++) {
                array_orders.push(resultAPIyear.orders[i].orders)
            }

            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: resultAPIyear.years,
                    datasets: [{
                        label: 'Ordini',
                        data: array_orders,
                        parsing: {
                            yAxisKey: 'orders'
                        }
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    aspectRatio: 1,
                    backgroundColor: 'rgba(241, 48, 5, 0.2)',
                    borderColor: 'rgba(241, 48, 5, 1)',
                    borderWidth: 1,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            /////////////////////////////////////////////
            /////////////////////////////////////////////
            /////////////////////////////////////////////
            /////////////////////////////////////////////
            /////////////////////////////////////////////

            const resultAmountMonth = await fetch('/admin/charts/amount/month', {
                method: 'GET',
            }).then(response => response.json())

            console.log(resultAmountMonth);
            const ctxLineAmount = document.getElementById('lineChartAmount');
            const dataAmount = resultAmountMonth

            new Chart(ctxLineAmount, {
                type: 'line',
                data: {
                    labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio',
                        'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'
                    ],

                    datasets: [{
                        label: 'Totale incassi',
                        data: dataAmount,
                        parsing: {
                            yAxisKey: 'total'
                        }
                    }]
                },
                options: {
                    backgroundColor: 'rgba(241, 48, 5, 0.2)',
                    borderColor: 'rgba(241, 48, 5, 1)',
                    borderWidth: 1,
                    responsive: true,
                    maintainAspectRatio: false,
                    aspectRatio: 1,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


        })
    </script>
@endsection
