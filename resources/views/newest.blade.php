<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="{{ env('FAVICON') }}">
	<link rel="icon" type="image/png" href="{{ env('FAVICON') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

	<!-- Metatags -->
	<title>{{ env('ISPAGRAM_APP_NAME') }}</title>
	<meta name="title" content="{{ env('ISPAGRAM_APP_NAME') }}" />
	<meta name="description" content="{{ env('ISPAGRAM_APP_NAME') }}" />

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{ env('APP_URL') }}" />
	<meta property="og:title" content="{{ env('ISPAGRAM_APP_NAME') }}" />
	<meta property="og:description" content="{{ env('ISPAGRAM_APP_NAME') }}" />
	<meta property="og:image" content="{{ env('ISPAGRAM_APP_BANNER') }}" />

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image" />
	<meta property="twitter:url" content="{{ env('APP_URL') }}" />
	<meta property="twitter:title" content="{{ env('ISPAGRAM_APP_NAME') }}" />
	<meta property="twitter:description" content="{{ env('ISPAGRAM_APP_NAME') }}" />
	<meta property="twitter:image" content="{{ env('ISPAGRAM_APP_BANNER') }}" />

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Source+Sans+Pro:400,600,700" rel="stylesheet">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!-- Main CSS -->
	<link href="mundana/css/main.css" rel="stylesheet" />
</head>
@php
	use Carbon\Carbon;
@endphp
<body>
	@include('components.header-mundana')

	<div class="container">
		<div class="row justify-content-between">
			<div class="col-md-12">
				<h5 class="font-weight-bold spanborder">
					<a class="text-dark"  href="/newest">
						<span>Artikel Terbaru</span>
					</a>
				</h5>
				@foreach ($newest as $item)
					<div class="mb-3 d-flex justify-content-between">
						<div class="pr-3">
							<h2 class="mb-1 h4 font-weight-bold">
								<a class="text-dark" href="/article/{{ $item->slug }}">
									{{ $item->title }}
								</a>
							</h2>
							<p>
								{{ $item->description }}
							</p>
							<div class="card-text text-muted small">
								{{ $item->name }}
							</div>
							<small class="text-muted">{{ Carbon::parse($item->created_at)->diffForHumans(['parts' => 2]) }}</small>
						</div>
						<img height="120" src="{{ env('PUBLIC_FTP_URL') . '/banner/' . $item->banner  }}">
					</div>
				@endforeach
			</div>
		</div>
	</div>

	@include('components.footer-mundana')

	<script src="mundana/js/vendor/jquery.min.js" type="text/javascript"></script>
	<script src="mundana/js/vendor/popper.min.js" type="text/javascript"></script>
	<script src="mundana/js/vendor/bootstrap.min.js" type="text/javascript"></script>
	<script src="mundana/js/functions.js" type="text/javascript"></script>
</body>

</html>