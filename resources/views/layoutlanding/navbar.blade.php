<nav class="navbar navbar-expand-lg navbar-dark bg-landing py-4 text-uppercase sticky-top">
    <div class="container px-1">
        <a class="navbar-brand" href="{{route('landing')}}">PEMINJAMAN RUANGAN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{route('landing')}}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="https://ft.umj.ac.id/ftumj/About.html" target="_blank">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('landingpage.kontak')}}">Kontak</a></li>
                @guest
                <li class="nav-item"><a class="nav-link" href="{{route('landingpage.login')}}">Masuk</a></li>
                @endguest
                @auth
                @if(Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Dekan')
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" class="nav-link" onclick="document.getElementById('logout-form').submit()">Logout</a>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{route('landingpage.histori')}}">Riwayat</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item nav-link" href="{{ route('landingpage.profile')}}">Profile</a></li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a href="#" class="dropdown-item nav-link" onclick="document.getElementById('logout-form').submit()">Logout</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>
