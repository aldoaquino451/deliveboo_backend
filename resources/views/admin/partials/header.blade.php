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

        <div class="d-flex align-items-center">
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-capitalize fs-5" href="#" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('admin.index') }}">{{ __('Dashboard') }}</a>
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
