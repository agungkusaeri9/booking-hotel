<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Beranda' }}</title>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    @stack('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="{{ route('home') }}">Hotel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                   @auth
                   <a class="nav-item nav-link" href="{{ route('transaction.index') }}">Transaksi</a>
                   @endauth
                    <a class="nav-item nav-link" href="{{ route('about') }}">Tentang Kami</a>
                </div>
                <ul class="navbar-nav ml-auto">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a href="{{ route('logout') }}" title="Logout" onclick="event.preventDefault();
                            document.getElementById('formLogout').submit();" class="dropdown-item">
                            Logout
                            </a>
                        </div>
                        <form action="{{ route('logout') }}" method="post" id="formLogout">
                            @csrf
                          </form>
                    </li>
                    @else 
                    <a class="nav-item nav-link" href="{{ route('login') }}">Login</a>
                    @endauth
                </ul>
            </div>
        </div>
      </nav>
    
    <div style="margin-top: 90px;min-height:600px">
        @yield('content')
    </div>

    <footer style="background: black;margin-bottom:0px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 text-white px-3 py-4">
                    <h5>{{ App\Models\Setting::first()->name }}</h5>
                    <p style="font-size: 14px">{{ App\Models\Setting::first()->description }}</p>
                </div>
            </div>
        </div>
    </footer>
<script src="{{ asset('assets/frontend/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap.bundle.min.js') }}"></script>
@stack('scripts')
</body>
</html>