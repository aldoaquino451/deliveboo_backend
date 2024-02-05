<aside>

    <div class="modal-button">
        <button class="m-0 p-0 pe-1 d-flex justify-content-center align-items-center">
            @if (Route::is('admin.index'))
                <i class="fa-solid fa-house"></i>
            @elseif (Route::is('admin.products.index'))
                <i class="fa-solid fa-list-ul"></i>
            @elseif (Route::is('admin.orders.index'))
                <i class="fa-solid fa-clipboard-list"></i>
            @elseif (Route::is('admin.dashboard'))
                <i class="fa-solid fa-square-poll-vertical"></i>
            @else
                <i class="fa-solid fa-bars"></i>
            @endif
        </button>
    </div>

    <ul class="m-0">
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
        const button = document.querySelector('.modal-button');
        const menu = document.querySelector('ul');

        button.addEventListener('click', function() {
            button.style.display = 'none';
            menu.style.display = 'flex';
        })

        window.addEventListener('click', function(event) {
            if (!button.contains(event.target) && !menu.contains(event.target) && button.style.display === 'none') {
                button.style.display = 'block';
                menu.style.display = 'none';
            }
        });
    </script>

</aside>
