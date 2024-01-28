<div>

    <p>Grazie per il tuo ordine!</p>
    
    <p>Dettagli dell'ordine:</p>
    
    <ul>
        @foreach($order->products as $product)
            <li>{{ $product->name }} - €{{ $product->price }} </li>
        @endforeach
    </ul>
    
    <p>Totale: €{{ $order->total_price }}</p>
    
    <p>Riceverai una conferma quando il tuo ordine sarà spedito.</p>
    
    <p>Grazie per aver scelto il nostro servizio di delivery!</p>

</div>
