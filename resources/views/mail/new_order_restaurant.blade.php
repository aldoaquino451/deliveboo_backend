<div>

<p>È stato effettuato un nuovo ordine!</p>
    
    <p class="fw-bold">Dettagli dell'ordine:</p>

    <p>Ordine numero: {{ $order->order_number }}</p>
    <p>Emesso il: {{ $order->created_at }}</p>
    
    <ul>
        @foreach($order->products as $product)
            <li>{{ $product->name }} - Quantità: {{ $product->quantity }}</li>
        @endforeach
    </ul>
    
    <p class="fw-bold">Dati Consegna: {{ $order->name }} {{ $order->lastname }}</p>
    <p>Nome: {{ $order->name }} {{ $order->lastname }}</p>
    <p>Indirizzo: {{ $order->address }}</p>
    <p>Email: {{ $order->email }}</p>
    <p>Telefono: {{ $order->phone }}</p>
    
    <p>Grazie per utilizzare il nostro servizio di delivery!</p>

    <p>{{$order->product}}</p>
</div>
