{{-- edited by Sofia Gallo --}}
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
	<div class="row g-0">
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
					<a href="#" class="nav-link text-white">{{ __('admin.nav.products') }}</a>
				</li>
				<li>
					<a href="{{ route('home') }}" class="mt-2 btn bg-primary text-white">{{ __('admin.nav.back_to_home') }}</a>
				</li>
			</ul>
		</div>
		<div class="col content-grey">
			<nav class="p-3 shadow text-end">
				<span class="profile-font">{{ __('admin.role_label') }}</span>
				<img class="img-profile rounded-circle" src="{{ asset('/img/undraw_profile.svg') }}" alt="{{ __('admin.role_label') }}" />
			</nav>
			<div class="g-0 m-5">
				@yield('content')
			</div>
		</div>
	</div>
	<div class="copyright py-4 text-center text-white">
		<div class="container">
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
