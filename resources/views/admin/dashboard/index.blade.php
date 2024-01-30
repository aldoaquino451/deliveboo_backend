@extends('layouts.admin')

@section('content')
    <h1>{{ $monthlyTotal }}</h1>
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
            @foreach ($orders as $order)
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
                <canvas id="barChart"></canvas>
            </div>
            <div class="chart col">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {


            const resultAPI = await fetch('/api/charts/order', {
                method: 'GET',
            }).then(response => response.json())

            console.log(resultAPI);

            const ctxBar = document.getElementById('barChart');
            // const data = [{
            //         x: 'Jan',
            //         orders: 95
            //     },
            //     {
            //         x: 'Feb',
            //         orders: 105
            //     },
            //     {
            //         x: 'Mar',
            //         orders: 62
            //     },
            //     {
            //         x: 'Apr',
            //         orders: 25
            //     },
            //     {
            //         x: 'May',
            //         orders: 42
            //     },
            //     {
            //         x: 'Jun',
            //         orders: 50
            //     },
            //     {
            //         x: 'Jul',
            //         orders: 73
            //     },
            //     {
            //         x: 'Aug',
            //         orders: 86
            //     },
            //     {
            //         x: 'Sep',
            //         orders: 90
            //     },
            //     {
            //         x: 'Oct',
            //         orders: 62
            //     },
            //     {
            //         x: 'Nov',
            //         orders: 71
            //     },
            //     {
            //         x: 'Dec',
            //         orders: 90
            //     }
            // ];

            const data = resultAPI

            new Chart(ctxBar, {
                type: 'line',
                data: {
                    labels: ['January', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                        'Nov', 'Dec'
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

            const ctxLine = document.getElementById('lineChart');
            const data2 = [{
                    x: '2019',
                    tot_orders: 250
                },
                {
                    x: '2020',
                    tot_orders: 189
                },
                {
                    x: '2021',
                    tot_orders: 162
                },
                {
                    x: '2022',
                    tot_orders: 225
                },
                {
                    x: '2023',
                    tot_orders: 142
                }
            ];

            new Chart(ctxLine, {
                type: 'bar',
                data: {
                    labels: ['2019', '2020', '2021', '2022', '2023'],
                    datasets: [{
                        label: 'Ordini',
                        data: data2,
                        parsing: {
                            yAxisKey: 'tot_orders'
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

        })
    </script>
@endsection
