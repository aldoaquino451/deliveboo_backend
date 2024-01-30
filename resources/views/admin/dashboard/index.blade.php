@extends('layouts.admin')

@section('content')
    {{-- <h1>{{ $monthlyTotal }}</h1> --}}
    <h2 class="text-capitalize text-center fw-bold">Statistiche</h2>

    <div class="container-fluid">

        <div class="charts-container row row-cols-1 row-cols-lg-2">
            <div class="chart col p-4 mt-2">
                <canvas id="lineChartOrders"></canvas>
            </div>
            <div class="chart col p-4 mt-2">
                <canvas id="barChartOrders"></canvas>
            </div>
            <div class="chart col p-4 mt-2">
                <canvas id="lineChartAmount"></canvas>
            </div>
            <div class="chart col p-4 mt-2">
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
                        label: 'Ordini mensili',
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
                        label: 'Ordini annui',
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

            // Grafico linear per totale amount mensile
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
                        label: 'Incassi mensili',
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

            /////////////////////////////////////////////
            /////////////////////////////////////////////
            /////////////////////////////////////////////
            /////////////////////////////////////////////
            /////////////////////////////////////////////

            // Grafico linear per totale amount annuo
            const resultAmountYear = await fetch('/admin/charts/amount/year', {
                method: 'GET',
            }).then(response => response.json())
            console.log(resultAmountYear);
            const ctxBarAmount = document.getElementById('barChartAmount');

            let array_amount = [];
            for (let c = 0; c < resultAmountYear.amount.length; c++) {
                array_amount.push(resultAmountYear.amount[c].amount)
            }

            new Chart(ctxBarAmount, {
                type: 'bar',
                data: {
                    labels: resultAmountYear.years,
                    datasets: [{
                        label: 'Incassi annui',
                        data: array_amount,
                        parsing: {
                            yAxisKey: 'amount',
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
