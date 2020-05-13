<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Dudeck Adrien">
    <meta name="generator" content="Jekyll v3.8.6">
    @yield('extra-meta')
    <title>E-commerce · @yield('title')</title>

    <!-- Extra-Scrit -->
    @yield('extra-script')


    <!-- Library core JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('lib/perfect-scrollbar@1.4.0/js/perfect-scrollbar.min.js') }}"></script>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/4.4/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">

    <!-- Library core CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fontawesome-5.11.2/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/perfect-scrollbar@1.4.0/css/perfect-scrollbar.css') }}">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/ecommerce.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app" class="container">
        <header class="header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    @if(Auth::check())
                    <a class="text-dark nav-link" href="{{ route('cart.index') }}"><i class="fas fa-cart-arrow-down"></i>
                        PANIER <span class="badge badge-pill badge-info">{{ Cart::count() }}
                            <!--Retourne le nombre d'article dans le panier--></span></a>
                    @endif
                </div>
                <div class="col-4 text-center">
                    <a class="header-logo text-dark font-weight-bold" href="{{ route('products.index') }}"><i
                            class="fas fa-shopping-cart text-lg text-info"></i> E-commerce</a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <!-- Right Side Of Navbar -->
                    @include('partials.auth')
                </div>
            </div>
        </header>

        <div class="nav-scroller py-1 mb-2">
            <nav class="nav d-flex justify-content-between">
                @foreach (App\Models\Category::all() as $category)
                <a class="p-2 nav-link"
                    href="{{ route('products.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                @endforeach
                @include('partials.search')
            </nav>
        </div>
        <!-- renvoi un message flash en cas de succès -->
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- renvoi un message flash en cas d'erreur -->
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul class="mb-0 mt-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
                <div class="col-md-6 px-0">
                    <h1 class="display-4 font-italic">Title of a longer featured blog product</h1>
                    <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and
                        efficiently about what’s most interesting in this product’s contents.</p>
                    <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
                </div>
            </div> --}}

        @if (request()->input('search'))
        <h5>{{ $products->total() }} résultats de recherche pour {{ request()->qry }}</h5>
        @endif
        <div class="row mb-2 justify-content-center align-items-center" style="min-height: 80vh;">
            @yield('content')
        </div>
        <footer class="footer">
            <p>Ecommerce template built by <a href="https://github.com/TheFury-BOY">TheFury-BOY</a>.</p>
            <p>
                <a href="#">Back to top</a>
            </p>
        </footer>
        @yield('extra-js')
</body>

</html>
