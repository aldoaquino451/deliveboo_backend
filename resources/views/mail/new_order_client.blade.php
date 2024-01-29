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

        <p>Grazie <strong style="text-transform:capitalize">{{ $order->name }}</strong>, il tuo ordine è stato
            confermato!</p>

        <p style="margin-bottom:10px">Di seguito troverai il dettaglio del tuo ordine: </p>

        <h6>{{ $order->restaurant->name_restaurant }}</h6>

        <ul>
            @foreach ($order->products as $product)
                <li>{{ $product->pivot->quantity }}x - {{ $product->name }} - &euro;{{ $product->price }}</li>
            @endforeach
        </ul>

        <p>Totale: <span style="font-weight: 600">&euro;{{ $order->total_price }}</span></p>

        <p style="margin-bottom:5px">Verrà consegnato all'indirizzo: {{ $order->address }}.</p>

        <p style="margin-bottom:5px">Riceverai una conferma quando il tuo ordine sarà spedito.</p>

        <p style="margin-bottom:5px">Grazie per aver scelto il nostro servizio di delivery!</p>

    </div>

</body>

</html>
