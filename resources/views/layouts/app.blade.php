<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="robots" content="all,follow"> --}}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Google fonts-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Lightbox-->
    <link rel="stylesheet" href="{{ asset('frontend/vendor/lightbox2/css/lightbox.min.css') }}">
    <!-- Range slider-->
    <link rel="stylesheet" href="{{ asset('frontend/vendor/nouislider/nouislider.min.css') }}">
    <!-- Bootstrap select-->
    <link rel="stylesheet" href="{{ asset('frontend/vendor/bootstrap-select/css/bootstrap-select.min.css') }}">
    <!-- Owl Carousel-->
    <link rel="stylesheet" href="{{ asset('frontend/vendor/owl.carousel2/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/vendor/owl.carousel2/assets/owl.theme.default.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.default.css') }}" id="theme-stylesheet">
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <!-- Tweaks for older IEs-->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <style>
        @media (min-width: 1200px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl {
                max-width: 1500px;
            }
        }
    </style>

    @yield('style')
</head>

<body>
    <div id="app" class="page-holder {{ request()->routeIs('frontend.detail') ? ' bg-light' : '' }}">
        <!-- navbar-->
        <header class="header bg-white">
            <div class="container px-0 px-lg-3">
                <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0">
                    <a class="navbar-brand" href="{{ route('frontend.index') }}">
                        <span class="font-weight-bold text-uppercase text-dark">Boutique</span>
                    </a>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <!-- Link-->
                                <a class="nav-link {{ request()->routeIs('frontend.index') ? ' active' : '' }}"
                                    href="{{ route('frontend.index') }}">
                                    Home
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.cart') }}">
                                    <i class="fas fa-dolly-flatbed mr-1 text-gray"></i>
                                    Cart
                                    <small class="text-gray">(2)</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="far fa-heart mr-1"></i>
                                    <small class="text-gray"> (0)</small>
                                </a>
                            </li>
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-user-alt mr-1 text-gray"></i>
                                        Login
                                    </a>
                                </li>
                            @else
                                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="pagesDropdown"
                                        href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                        {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}

                                    </a>
                                    <div class="dropdown-menu mt-3" aria-labelledby="pagesDropdown">
                                        <a class="dropdown-item border-0 transition-link"
                                            href="{{ route('frontend.index') }}">
                                            <i class="fas fa-user-alt mr-1 text-gray"></i>
                                            Profile
                                        </a>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button class="dropdown-item border-0 transition-link"
                                                style="cursor: pointer;outline: none;background:none;border:none"
                                                type="submit">
                                                <i class="fas fa-sign-out-alt mr-1 text-gray"></i>
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item">

                                </li>
                            @endguest
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Content -->
        <main class="container">
            @yield('content')
        </main>


        <!-- Footer -->
        <footer class="bg-dark text-white">
            <div class="container py-4">
                <div class="row py-5">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <h6 class="text-uppercase mb-3">Customer services</h6>
                        <ul class="list-unstyled mb-0">
                            <li><a class="footer-link" href="#">Help &amp; Contact Us</a></li>
                            <li><a class="footer-link" href="#">Returns &amp; Refunds</a></li>
                            <li><a class="footer-link" href="#">Online Stores</a></li>
                            <li><a class="footer-link" href="#">Terms &amp; Conditions</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <h6 class="text-uppercase mb-3">Company</h6>
                        <ul class="list-unstyled mb-0">
                            <li><a class="footer-link" href="#">What We Do</a></li>
                            <li><a class="footer-link" href="#">Available Services</a></li>
                            <li><a class="footer-link" href="#">Latest Posts</a></li>
                            <li><a class="footer-link" href="#">FAQs</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-uppercase mb-3">Social media</h6>
                        <ul class="list-unstyled mb-0">
                            <li><a class="footer-link" href="#">Twitter</a></li>
                            <li><a class="footer-link" href="#">Instagram</a></li>
                            <li><a class="footer-link" href="#">Tumblr</a></li>
                            <li><a class="footer-link" href="#">Pinterest</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-top pt-4" style="border-color: #1d1d1d !important">
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="small text-muted mb-0">&copy; 2020 All rights reserved.</p>
                        </div>
                        <div class="col-lg-6 text-lg-right">
                            <p class="small text-muted mb-0">Template designed by <a class="text-white reset-anchor"
                                    href="https://bootstraptemple.com/p/bootstrap-ecommerce">Bootstrap Temple</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!--  Modal -->
    <div class="modal fade" id="productView" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="row align-items-stretch">
                        <div class="col-lg-6 p-lg-0">
                            <a class="product-view d-block h-100 bg-cover bg-center"
                                style="background: url(img/product-5.jpg)" href="img/product-5.jpg"
                                data-lightbox="productview" title="Red digital smartwatch">
                            </a>
                            <a class="d-none" href="img/product-5-alt-1.jpg" title="Red digital smartwatch"
                                data-lightbox="productview">
                            </a>
                            <a class="d-none" href="img/product-5-alt-2.jpg" title="Red digital smartwatch"
                                data-lightbox="productview">
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <button class="close p-4" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="p-5 my-md-4">
                                <ul class="list-inline mb-2">
                                    <li class="list-inline-item m-0">
                                        <i class="fas fa-star small text-warning"></i>
                                    </li>
                                    <li class="list-inline-item m-0">
                                        <i class="fas fa-star small text-warning"></i>
                                    </li>
                                    <li class="list-inline-item m-0">
                                        <i class="fas fa-star small text-warning"></i>
                                    </li>
                                    <li class="list-inline-item m-0">
                                        <i class="fas fa-star small text-warning"></i>
                                    </li>
                                    <li class="list-inline-item m-0">
                                        <i class="fas fa-star small text-warning"></i>
                                    </li>
                                </ul>
                                <h2 class="h4">Red digital smartwatch</h2>
                                <p class="text-muted">$250</p>
                                <p class="text-small mb-4">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    In
                                    ut ullamcorper leo, eget euismod orci. Cum sociis natoque penatibus et magnis
                                    dis
                                    parturient montes nascetur ridiculus mus. Vestibulum ultricies aliquam
                                    convallis.
                                </p>
                                <div class="row align-items-stretch mb-4">
                                    <div class="col-sm-7 pr-sm-0">
                                        <div
                                            class="border d-flex align-items-center justify-content-between py-1 px-3">
                                            <span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                                            <div class="quantity">
                                                <button class="dec-btn p-0">
                                                    <i class="fas fa-caret-left"></i>
                                                </button>
                                                <input class="form-control border-0 shadow-0 p-0" type="text"
                                                    value="1">
                                                <button class="inc-btn p-0">
                                                    <i class="fas fa-caret-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 pl-sm-0">
                                        <a class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0"
                                            href="cart.html">
                                            Add to cart
                                        </a>
                                    </div>
                                </div>
                                <a class="btn btn-link text-dark p-0" href="#">
                                    <i class="far fa-heart mr-2"></i>
                                    Add to wish list
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript files-->
    <script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/lightbox2/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/owl.carousel2/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js') }}"></script>
    <script src="{{ asset('frontend/js/front.js') }}"></script>
    <script>
        // ------------------------------------------------------- //
        //   Inject SVG Sprite - 
        //   see more here 
        //   https://css-tricks.com/ajaxing-svg-sprite/
        // ------------------------------------------------------ //
        function injectSvgSprite(path) {

            var ajax = new XMLHttpRequest();
            ajax.open("GET", path, true);
            ajax.send();
            ajax.onload = function(e) {
                var div = document.createElement("div");
                div.className = 'd-none';
                div.innerHTML = ajax.responseText;
                document.body.insertBefore(div, document.body.childNodes[0]);
            }
        }
        // this is set to BootstrapTemple website as you cannot 
        // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
        // while using file:// protocol
        // pls don't forget to change to your domain :)
        injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
    </script>

    @yield('script')
</body>

</html>
