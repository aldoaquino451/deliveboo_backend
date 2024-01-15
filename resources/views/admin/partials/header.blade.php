<header class="bg-dark text-center text-white fs-1">
    <div class="container d-flex justify-content-between">
        <span>logo</span>

        <a href="{{route('admin.index')}}">HOME</a>
        <a href="{{route('admin.products.index')}}">PRODOTTI</a>
        <a href="{{route('admin.dashboard')}}">DASHBOARD</a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-primary" type="submit">
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </form>
    </div>
</header>
