
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Watchbase</title>
    <link rel="shortcut icon" href="{{ asset("images/logo.svg") }}">
    <!-- CSS -->
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("css/styles.css") }}">
    <link rel="stylesheet" href="{{ asset("css/dashboard.css") }}">
    @stack('styles')
  </head>
  <body>
        <nav class="navbar navbar-expand-lg navbar-light sticky-top bg-white flex-md-nowrap p-0 shadow-sm">
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 bg-white align-items-center" href="{{ route("pages.home") }}">
                <img src="{{ asset("images/logo.svg") }}" alt="" width="20" height="20" class="d-inline-block mr-1" alt="" loading="lazy">
                Watchbase
            </a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav flex-row px-3 bg-white ml-auto">
                @guest
                    <li class="nav-item text-nowrap mr-2">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item text-nowrap">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item text-nowrap mr-2">
                        <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item text-nowrap">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
                    <div class="sidebar-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link  @if(request()->routeIs("pages.home")) active @endif" href="{{ route("pages.home") }}">
                                    <span data-feather="home"></span>
                                    Home @if(request()->routeIs("pages.home")) <span class="sr-only">(current)</span> @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs("pages.videos") && request("filter") == "latest-videos") active @endif" href="{{ route("pages.videos", "latest-videos") }}">
                                    <span data-feather="activity"></span>
                                    Latest Videos  @if(request()->routeIs("pages.videos") && request("filter") == "latest-videos") <span class="sr-only">(current)</span> @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs("pages.videos") && request("filter") == "most-popular") active @endif" href="{{ route("pages.videos", "most-popular") }}">
                                    <span data-feather="trending-up"></span>
                                    Most Popular @if(request()->routeIs("pages.videos") && request("filter") == "most-popular") <span class="sr-only">(current)</span> @endif
                                </a>
                            </li>
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link  @if(request()->routeIs("pages.videos") && request("filter") == "my-uploads") active @endif" href="{{ route("pages.videos", "my-uploads") }}">
                                        <span data-feather="archive"></span>
                                        My Uploads @if(request()->routeIs("pages.videos") && request("filter") == "my-uploads") <span class="sr-only">(current)</span> @endif
                                    </a>
                                </li>
                            @endauth
                        </ul>
                        @auth
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span>Account</span>
                                <a class="d-flex align-items-center text-muted" href="#" aria-label="Manage account">
                                </a>
                            </h6>
                            <ul class="nav flex-column mb-2">
                                <li class="nav-item">
                                    <a class="nav-link @if(request()->routeIs("videos.*")) active @endif" href="{{ route("videos.index") }}">
                                        <span data-feather="video"></span>
                                        Manage Videos
                                        @if(request()->routeIs("videos.*")) <span class="sr-only">(current)</span> @endif
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if(request()->routeIs("categories.*")) active @endif" href="{{ route("categories.index") }}">
                                        <span data-feather="layers"></span>
                                        Manage Categories
                                        @if(request()->routeIs("categories.*")) <span class="sr-only">(current)</span> @endif
                                    </a>
                                </li>
                            </ul>
                        @endauth
                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class="mt-2 pb-5">
                        @yield('content')
                    </div>
                    <footer class="py-4 text-secondary">
                        &copy; Watchbase 2020
                    </footer>
                </main>

            </div>
        </div>
        <!-- JS, Popper.js, Feather.js, and jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script>
            feather.replace();
        </script>
        @stack('scripts')
    </body>
</html>
