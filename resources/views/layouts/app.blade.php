{{-- Edited by David García Zapata --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('orders.app_name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="{{ url('/') }}">{{ __('orders.app_name') }}</a>
            <div class="vr bg-white mx-2 d-none d-lg-block"></div>
            @guest
            <a class="navbar-brand font-weight-bold" href="{{ route('login') }}">{{ __('ui.login') }}</a>
            <a class="navbar-brand font-weight-bold" href="{{ route('register') }}">{{ __('ui.register') }}</a>
            @else
            <form id="logout" action="{{ route('logout') }}" method="POST">
                <a role="button" class="nav-link active"
                    onclick="document.getElementById('logout').submit();">{{ __('ui.logout') }}</a>
                @csrf
            </form>
            @endguest
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('orders.my') }}">{{ __('orders.nav_orders') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart"></i>
                            {{ __('cart.nav_cart') }}
                            @if(session('cart'))
                                <span class="badge bg-danger">{{ array_sum(array_column(session('cart'), 'quantity')) }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
