@if ($jumbotron)
    <div class="jumbotron jumbotron-fluid mb-3 pt-0 pb-0 bg-lightblue position-relative">
        <div class="pl-4 pr-0 h-100 tofront">
            <div class="row justify-content-between">
                <div class="col-md-6 pt-6 pb-6 align-self-center">
                    <h1 class="secondfont mb-3 font-weight-bold">
                        {{ $jumbotron->title }}
                    </h1>
                    <p class="mb-3">
                        {{ $jumbotron->description }}
                    </p>
                    <a href="/article/{{ $jumbotron->slug }}" class="btn btn-dark">Baca Selengkapnya</a>
                </div>
                <div class="col-md-6 d-none d-md-block pr-0"
                    style="background-size:cover;background-image:url({{ env('PUBLIC_FTP_URL') . '/' . $jumbotron->banner }});">
                </div>
            </div>
        </div>
    </div>
@endif
