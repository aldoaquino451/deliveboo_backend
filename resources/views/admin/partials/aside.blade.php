<aside class="d-flex align-items-center">

    {{-- <button class="btn" onclick="saluto()">saluta!</button> --}}

    <ul class="m-0 d-flex flex-column">
        <li>
            <a href="{{ route('admin.index') }}" class="{{ Route::is('admin.index') ? 'active' : '' }} link-light ">
                <i class="fa-solid fa-house"></i>
                <span>Home</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.products.index') }}"
                class="{{ Route::is('admin.products.index') ? 'active' : '' }} link-light ">
                <i class="fa-solid fa-list-ul"></i>
                <span>Prodotti</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.orders.index') }}"
                class="{{ Route::is('admin.orders.index') ? 'active' : '' }} link-light ">
                <i class="fa-solid fa-clipboard-list"></i>
                <span>Ordini</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.dashboard') }}"
                class="{{ Route::is('admin.dashboard') ? 'active' : '' }} link-light ">
                <i class="fa-solid fa-square-poll-vertical"></i>
                <span>Statistiche</span>
            </a>
        </li>
    </ul>

    <script>
        function saluto() {
            console.log('ciao');
        }
    </script>

</aside>
