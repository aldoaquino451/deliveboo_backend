<header class="dashboard-header text-white d-flex align-items-center">

    <div class="container-header d-flex justify-content-between align-items-center">

        <h1 class="logo mb-0 text-center">Deliveboo</h1>
        <div class="d-flex align-items-center justify-content-end action">
            <span class="admin-name text-capitalize me-2 d-none d-sm-inline">{{ Auth::user()->name }}</span>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</header>
