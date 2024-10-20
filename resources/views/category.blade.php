<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="/mundana/img/favicon.ico">
	<link rel="icon" type="image/png" href="/mundana/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Kategori - {{ $kategori }}</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
		name='viewport' />
	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Source+Sans+Pro:400,700"
		rel="stylesheet">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
		integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!-- Main CSS -->
	<link href="/mundana/css/main.css" rel="stylesheet" />
</head>
@php
	use Carbon\Carbon;
@endphp
<body>
	@include('components.header-mundana')

	{{-- Main --}}
	<div class="container mt-5 mb-5">
		<div class="row">
			<div class="col-md-8">
				@if ($featured)
					<h5 class="font-weight-bold spanborder"><span>Featured in {{ $kategori }}</span></h5>
					<div class="card border-0 mb-5 box-shadow">
						<div
							style="background-image: url({{ env('PUBLIC_FTP_URL') . '/' . $featured->banner }}); height: 350px; background-size: cover; background-repeat: no-repeat;">
						</div>
						<div class="card-body px-0 pb-0 d-flex flex-column align-items-start">
							<h2 class="h2 font-weight-bold">
								<a class="text-dark" href="/article/{{ $featured->slug }}">
									{{ $featured->title }}
								</a>
							</h2>
							<p class="card-text">
								{{ $featured->description }}
							</p>
							<div>
								<small class="d-block"><a class="text-muted" href="/">{{ $featured->uploader }}</a></small>
								<small class="text-muted">{{ Carbon::parse($featured->created_at)->diffForHumans(['parts' => 2]) }}</small>
							</div>
						</div>
					</div>
				@endif
				<h5 class="font-weight-bold spanborder"><span>Terbaru</span></h5>
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
								{{ $item->uploader }}
							</div>
							<small class="text-muted">Dec 12 · 5 min read</small>
						</div>
						<img height="120" src="{{ env('PUBLIC_FTP_URL') . '/' . $item->banner }}">
					</div>
				@endforeach
			</div>
			<div class="col-md-4 pl-4">
				<div class="sticky-top">
					<h5 class="font-weight-bold spanborder"><span>Popular in {{ $kategori }}</span></h5>
					<ol class="list-featured">
						@foreach ($popular as $item)	
							<li>
								<span>
									<h6 class="font-weight-bold">
										<a href="/article/{{ $item->slug }}" class="text-dark">
											{{ $item->title }}
										</a>
									</h6>
									<p class="text-muted">
										{{ $item->uploader }}
									</p>
								</span>
							</li>
						@endforeach
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- End Main -->

	@include('components.footer-mundana')

	<!----JAVASCRIPTS--->
	<script src="/mundana/js/vendor/jquery.min.js" type="text/javascript"></script>
	<script src="/mundana/js/vendor/popper.min.js" type="text/javascript"></script>
	<script src="/mundana/js/vendor/bootstrap.min.js" type="text/javascript"></script>
	<script src="/mundana/js/functions.js" type="text/javascript"></script>
</body>

</html>