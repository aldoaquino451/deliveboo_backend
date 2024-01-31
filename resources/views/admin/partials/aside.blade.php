<aside>
    <ul>
        <li>
            <a href="{{ route('admin.products.index') }}"
                class="{{ Route::is('admin.products.index') ? 'active' : '' }} link-light ">
                <i class="fa-solid fa-list-ul"></i><span>Prodotti</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.dashboard') }}"
                class="{{ Route::is('admin.dashboard') ? 'active' : '' }} link-light ">
                <i class="fa-solid fa-square-poll-vertical"></i><span>Statistiche</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.orders.index') }}"
                class="{{ Route::is('admin.orders.index') ? 'active' : '' }} link-light ">
                <i class="fa-solid fa-clipboard-list"></i><span>Ordini</span>
            </a>
        </li>
    </ul>
</aside>

<div class="btn-aside">
    <button class="btn btn-danger">ciao</button>
</div>
