<header class="dashboard-header text-white d-flex align-items-center">

    <div class="container d-flex justify-content-between align-items-center">

        <a href="{{ route('admin.index') }}" class="link-light fs-4 home"><i class="fa-solid fa-house"></i></a>

        <h1 class="logo text-center">Deliveboo</h2>

            <div class="d-flex align-items-center justify-content-end action">
                <span class="admin-name text-capitalize me-2">{{ Auth::user()->name }}</span>

                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>

    </div>

</header>
