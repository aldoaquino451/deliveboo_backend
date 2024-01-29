<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Titolo  --}}
    <title>Deliveboo</title>

    {{-- Font awesome  --}}
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.css'
        integrity='sha512-tx5+1LWHez1QiaXlAyDwzdBTfDjX07GMapQoFTS74wkcPMsI3So0KYmFe6EHZjI8+eSG0ljBlAQc3PQ5BTaZtQ=='
        crossorigin='anonymous' />

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400;1,700&family=Montserrat:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])

    <!-- Includi Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


</head>

<body>

    <div>

        <p>È stato effettuato un nuovo ordine!</p>

        <p style="margin-bottom: 5px">Numero dell'ordine: {{ $order->order_number }}</p>
        <p style="margin-bottom: 5px">Emesso il: {{ $order->created_at->format('d/m/Y H:m') }}</p>

        <h6 style="margin-top: 20px">Dettagli dell'ordine:</h6>

        <ul style="margin-bottom: 20px">
            @foreach ($order->products as $product)
                <li>{{ $product->pivot->quantity }}x - {{ $product->name }} - &euro;{{ $product->price }}</li>
            @endforeach
        </ul>

        <p>Totale: <span style="font-weight: 600">&euro;{{ $order->total_price }}</span></p>

        <h6>Dati Consegna:</h6>
        <p style="margin-bottom: 5px">Nome: <span
                style="text-transform: capitalize; font-weight: 600">{{ $order->name }}
                {{ $order->lastname }}</span></p>
        <p style="margin-bottom: 5px">Indirizzo: <span
                style="text-transform: capitalize; font-weight: 600">{{ $order->address }}</span>
        </p>
        <p style="margin-bottom: 5px">Email: <span style="font-weight: 600">{{ $order->email }}</span></p>
        <p style="margin-bottom: 5px">Telefono: <span style="font-weight: 600">{{ $order->phone_number }}</span>
        </p>

        <p style="margin-top: 20px">Grazie per utilizzare il nostro servizio di delivery!</p>

    </div>

</body>

</html>
