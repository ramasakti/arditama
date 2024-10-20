<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="{{ env('FAVICON') }}">
	<link rel="icon" type="image/png" href="{{ env('FAVICON') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>{{ $article->title }}</title>
	<meta name="title" content="{{ $article->title }}" />
	<meta name="description" content="{{ $article->description }}" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	
	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{ env('APP_URL') . '/article/' . $article->slug }}" />
	<meta property="og:title" content="{{ $article->title }}" />
	<meta property="og:description" content="{{ $article->description }}" />
	<meta property="og:image" content="{{ env('PUBLIC_FTP_URL') . '/' . $article->banner }}" />

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image" />
	<meta property="twitter:url" content="{{ env('APP_URL') . '/article/' . $article->slug }}" />
	<meta property="twitter:title" content="{{ $article->title }}" />
	<meta property="twitter:description" content="{{ $article->description }}" />
	<meta property="twitter:image" content="{{ env('PUBLIC_FTP_URL') . '/' . $article->banner }}" />

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Source+Sans+Pro:400,700" rel="stylesheet">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!-- Main CSS -->
	<link href="/mundana/css/main.css" rel="stylesheet" />
</head>
@php
	use Carbon\Carbon;
@endphp
<body>
	@include('components.header-mundana')

	<div class="container">
		<div class="jumbotron jumbotron-fluid mb-3 pl-0 pt-0 pb-0 bg-white position-relative">
			<div class="h-100 tofront">
				<div class="row justify-content-between">
					<div class="col-md-6 pt-0 pb-6 pr-6 align-self-center">
						<p class="text-uppercase font-weight-bold">
							@foreach ($article->categories as $item)
								<a class="text-danger" href="/article/category/{{ $item->value }}">#{{ $item->label }}</a>
							@endforeach
						</p>
						<h1 class="display-4 secondfont mb-3 font-weight-bold">
							{{ $article->title }}
						</h1>
						<p class="mb-3">
							{{ $article->description }}
						</p>
						<div class="d-flex align-items-center">
							@if ($article->avatar)
								<img class="rounded-circle" src="{{ env('PUBLIC_FTP_URL') . '/' . $article->avatar }}" width="70">
							@else
								<img class="rounded-circle" src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png" width="70">
							@endif
							<small class="ml-2">
								{{ $article->uploader }}
								<span class="text-muted d-block">
									{{ Carbon::parse($article->created_at)->diffForHumans(['parts' => 2]) }}
								</span>
							</small>
						</div>
					</div>
					<div class="col-md-6 pr-0">
						<img src="{{ env('PUBLIC_FTP_URL') . '/' . $article->banner }}">
					</div>
				</div>
			</div>
		</div>
	</div>

    {{-- Main --}}
	<div class="container pt-4 pb-4">
		<div class="row justify-content-center">
			<div class="col-lg-2 pr-4 mb-4 col-md-12">
				<div class="sticky-top text-center">
					<div class="text-muted">
						Share this
					</div>
					<div class="share d-inline-block">
						<!-- AddToAny BEGIN -->
						<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
							<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
							<a class="a2a_button_facebook"></a>
							<a class="a2a_button_twitter"></a>
						</div>
						<script async src="https://static.addtoany.com/menu/page.js"></script>
						<!-- AddToAny END -->
					</div>
				</div>
			</div>
			<div class="col-md-12 col-lg-8">
				<article class="article-post">
					{!! $article->content !!}
				</article>
			</div>
		</div>
	</div>

	<div class="container pt-4 pb-4">
		<h5 class="font-weight-bold spanborder"><span>Read next</span></h5>
		<div class="row">
			<div class="col-lg-6">
				@if ($related_articles['featured'])	
					<div class="card border-0 mb-4 box-shadow h-xl-300">
						<div style="background-image: url({{ env('PUBLIC_FTP_URL') . '/' . $related_articles['featured']->banner }}); height: 150px; background-size: cover; background-repeat: no-repeat;">
						</div>
						<div class="card-body px-0 pb-0 d-flex flex-column align-items-start">
							<h2 class="h4 font-weight-bold">
								<a class="text-dark" href="{{ $related_articles['featured']->slug }}">{{ $related_articles['featured']->title }}</a>
							</h2>
							<p class="card-text">
								{{ $related_articles['featured']->description }}
							</p>
							<div>
								<small class="d-block"><a class="text-muted" href="#">{{ $related_articles['featured']->uploader }}</a></small>
								<small class="text-muted">{{ Carbon::parse($related_articles['featured']->created_at)->diffForHumans(['parts' => 2]) }}</small>
							</div>
						</div>
					</div>
				@endif
			</div>
			<div class="col-lg-6">
				@foreach ($related_articles['random_articles'] as $article)
					<div class="mb-3 d-flex align-items-center">
						<img height="80" src="{{ env('PUBLIC_FTP_URL') . '/' . $article->banner }}">
						<div class="pl-3">
							<h2 class="mb-2 h6 font-weight-bold">
								<a class="text-dark" href="{{ $article->slug }}">{{ $article->title }}</a>
							</h2>
							<div class="card-text text-muted small">
								{{ $article->uploader }}
							</div>
							<small class="text-muted">{{ Carbon::parse($article->created_at)->diffForHumans(['parts' => 2]) }}</small>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>	
	<!-- End Main -->

	@include('components.footer-mundana')

	<!--------------------------------------
JAVASCRIPTS
--------------------------------------->
	<script src="/mundana/js/vendor/jquery.min.js" type="text/javascript"></script>
	<script src="/mundana/js/vendor/popper.min.js" type="text/javascript"></script>
	<script src="/mundana/js/vendor/bootstrap.min.js" type="text/javascript"></script>
	<script src="/mundana/js/functions.js" type="text/javascript"></script>
</body>

</html>