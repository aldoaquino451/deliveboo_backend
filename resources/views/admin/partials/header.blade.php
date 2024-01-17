<header id="admin" class="bg-dark text-white">
    <div class="container h-100 py-2 d-flex justify-content-between">

        <div class="d-flex gap-5 align-items-center">
            <h3 class="m-0">LOGO</h3>
            <ul class="m-0 list-unstyled d-flex gap-4">
                <li>
                    <a href="{{ route('admin.index') }}" class="link-light">HOME</a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}" class="link-light">PRODOTTI</a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="link-light">DASHBOARD</a>
                </li>
            </ul>
        </div>

        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('admin.index') }}" class="link-light  text-decoration-none text-capitalize fs-5">
                {{ Auth::user()->name }}
            </a>

            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket ms-2"></i>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

    </div>
</header>
