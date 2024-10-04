{{-- Navbar --}}
<nav class="topnav navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/"><strong>{{ env('ISPAGRAM_APP_NAME') }}</strong></a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor02"
            aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarColor02" style="">
            <ul class="navbar-nav mr-auto d-flex align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./article.html">Culture</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./article.html">Tech</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./article.html">Politics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./article.html">Health</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./article.html">Collections</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./about.html">About</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->