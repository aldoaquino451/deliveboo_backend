<header class="bg-dark text-center text-white fs-1">
    <div class="container d-flex justify-content-between">
        <span>logo</span>

        <a href="{{ route('admin.index') }}">HOME</a>
        <a href="{{ route('admin.products.index') }}">PRODOTTI</a>
        <a href="{{ route('admin.dashboard') }}">DASHBOARD</a>

        <div>
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-capitalize" href="#" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    {{ __('Logout') }} <i class="fa-solid fa-right-from-bracket ms-2"></i>

                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

    </div>
</header>
