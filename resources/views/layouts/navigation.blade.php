<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Pagrindinis</a>
                </li>
                @if (!Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Prisijungimas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registracija</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('offers.list') }}">Pasiūlymai</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('freelancers.index') }}">Laisvai samdomi darbuotojai</a>
                </li>
                @auth()
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.index') }}">Mano užsakymai</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
