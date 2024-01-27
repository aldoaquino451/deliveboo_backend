<div>
    Gentile {{ $order->restaurant->name_restaurant }} hai appena ricevuto il seguente ordine:

    Ordine numero: {{ $order->order_number }} <br>
    Emesso il: {{ $order->created_at }} <br>

    Ordine:

    Dati consegna:
    Nome: {{ $order->name }}<br>
    Cognome: {{ $order->lastname }}<br>
    Indirizzo: {{ $order->address }}<br>
    Numero di telefono: {{ $order->phone_number }}<br>



</div>
