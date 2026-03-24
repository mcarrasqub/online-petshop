{{-- edited by Sofia Gallo and Mariana Carrasquilla Botero --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
	<link href="{{ asset('/css/admin.css') }}" rel="stylesheet" />
	<title>@yield('title', __('admin.title_default'))</title>
</head>

<body>
    <div class="row g-0 min-vh-100">
        <div class="p-3 col fixed text-white bg-dark">
            <a href="{{ route('admin.home.index') }}" class="text-white text-decoration-none">
                <span class="fs-4">{{ __('admin.panel') }}</span>
            </a>
            <hr />
            <ul class="nav flex-column">
                <li>
                    <a href="{{ route('admin.home.index') }}" class="nav-link text-white">{{ __('admin.nav.home') }}</a>
                </li>
                <li>
                    <a href="{{ route('admin.product.index') }}" class="nav-link text-white">{{ __('admin.nav.products') }}</a>
                </li>
                <li>
                    <a href="{{ route('admin.category.index') }}" class="nav-link text-white">{{ __('admin.nav.categories') }}</a>
                </li>
                <li class="mt-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-secondary w-100">
                            {{ __('ui.logout') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="col content-grey">
            <nav class="p-3 shadow text-end bg-dark text-white d-flex justify-content-end align-items-center">
                <div class="dropdown me-3">
                    <a class="text-white text-decoration-none dropdown-toggle" href="#" id="languageDropdownAdmin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ app()->getLocale() == 'en' ? 'English' : 'Español' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdownAdmin">
                        <li><a class="dropdown-item" href="{{ route('lang.switch', 'es') }}">Español</a></li>
                        <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a></li>
                    </ul>
                </div>
                <span class="profile-font text-white me-2">{{ __('admin.role_label') }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('/img/undraw_profile.svg') }}" alt="{{ __('admin.role_label') }}" />
            </nav>
            <div class="g-0 m-5">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
