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
    <script src="{{ asset('lib/jquery@3.4.1/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap-4.4.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('lib/perfect-scrollbar@1.4.0/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('lib/WOW/dist/wow.min.js') }}"></script>

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
    <link rel="stylesheet" href="{{ asset('lib/bootstrap-4.4.1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fontawesome-5.11.2/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/perfect-scrollbar@1.4.0/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('/lib/animate-css/animate.min.css') }}">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/ecommerce.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app" class="container">
        <header class="header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    <a class="text-muted" href="{{ route('carts.index') }}"><i class="fas fa-cart-arrow-down"></i>
                        Panier <span class="badge badge-pill badge-info">{{ Cart::count() }}
                            <!--Retourne le nombre d'article dans le panier--></span></a>
                </div>
                <div class="col-4 text-center">
                    <a class="header-logo text-dark font-weight-bold" href="{{ route('products.index') }}"><i
                            class="fas fa-shopping-cart text-lg text-info"></i> E-commerce</a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    @include('partials.search')
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

        @if (request()->input('qry'))
        <h5>{{ $products->total() }} résultats de recherche pour {{ request()->qry }}</h5>
        @endif
        <div class="row mb-2 align-items-center" style="min-height: 80vh;">
            @yield('content')
        </div>

        {{-- <main role="main" class="container">
            <div class="row">
                <div class="col-md-8 main">
                    <h3 class="pb-4 mb-4 font-italic border-bottom">
                        From the Firehose
                    </h3>

                    <div class="product">
                        <h2 class="product-title">Sample blog product</h2>
                        <p class="product-meta">January 1, 2014 by <a href="#">Mark</a></p>

                        <p>This blog product shows a few different types of content that’s supported and styled with Bootstrap.
                            Basic typography, images, and code are all supported.</p>
                        <hr>
                        <p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus
                            mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere
                            consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
                        <blockquote>
                            <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong>
                                ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </blockquote>
                        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet
                            fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                        <h2>Heading</h2>
                        <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non
                            commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus,
                            porta ac consectetur ac, vestibulum at eros.</p>
                        <h3>Sub-heading</h3>
                        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                        <pre><code>Example code block</code></pre>
                        <p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod.
                            Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
                        <h3>Sub-heading</h3>
                        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean
                            lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce
                            dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit
                            amet risus.</p>
                        <ul>
                            <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
                            <li>Donec id elit non mi porta gravida at eget metus.</li>
                            <li>Nulla vitae elit libero, a pharetra augue.</li>
                        </ul>
                        <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.
                        </p>
                        <ol>
                            <li>Vestibulum id ligula porta felis euismod semper.</li>
                            <li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>
                            <li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li>
                        </ol>
                        <p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>
                    </div><!-- /.product -->

                    <div class="product">
                        <h2 class="product-title">Another blog product</h2>
                        <p class="product-meta">December 23, 2013 by <a href="#">Jacob</a></p>

                        <p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus
                            mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere
                            consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
                        <blockquote>
                            <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong>
                                ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </blockquote>
                        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet
                            fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                        <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non
                            commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus,
                            porta ac consectetur ac, vestibulum at eros.</p>
                    </div><!-- /.product -->

                    <div class="product">
                        <h2 class="product-title">New feature</h2>
                        <p class="product-meta">December 14, 2013 by <a href="#">Chris</a></p>

                        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean
                            lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce
                            dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit
                            amet risus.</p>
                        <ul>
                            <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
                            <li>Donec id elit non mi porta gravida at eget metus.</li>
                            <li>Nulla vitae elit libero, a pharetra augue.</li>
                        </ul>
                        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet
                            fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                        <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.
                        </p>
                    </div><!-- /.product -->

                    <nav class="pagination">
                        <a class="btn btn-outline-primary" href="#">Older</a>
                        <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
                    </nav>

                </div><!-- /.main -->

                <aside class="col-md-4 sidebar">
                    <div class="p-4 mb-3 bg-light rounded">
                        <h4 class="font-italic">About</h4>
                        <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur
                            purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                    </div>

                    <div class="p-4">
                        <h4 class="font-italic">Archives</h4>
                        <ol class="list-unstyled mb-0">
                            <li><a href="#">March 2014</a></li>
                            <li><a href="#">February 2014</a></li>
                            <li><a href="#">January 2014</a></li>
                            <li><a href="#">December 2013</a></li>
                            <li><a href="#">November 2013</a></li>
                            <li><a href="#">October 2013</a></li>
                            <li><a href="#">September 2013</a></li>
                            <li><a href="#">August 2013</a></li>
                            <li><a href="#">July 2013</a></li>
                            <li><a href="#">June 2013</a></li>
                            <li><a href="#">May 2013</a></li>
                            <li><a href="#">April 2013</a></li>
                        </ol>
                    </div>

                    <div class="p-4">
                        <h4 class="font-italic">Elsewhere</h4>
                        <ol class="list-unstyled">
                            <li><a href="#">GitHub</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Facebook</a></li>
                        </ol>
                    </div>
                </aside><!-- /.sidebar -->

            </div><!-- /.row -->

        </main><!-- /.container --> --}}

        <footer class="footer">
            <p>Ecommerce template built by <a href="https://github.com/TheFury-BOY">TheFury-BOY</a>.</p>
            <p>
                <a href="#">Back to top</a>
            </p>
        </footer>
        <!-- Jquery core JS -->
        <script src="{{ asset('lib/jquery@3.4.1/jquery-3.4.1.min.js') }}"></script>
        <!-- Bootstrap core JS -->
        <script src="{{ asset('lib/bootstrap-4.4.1/js/bootstrap.min.js') }}">
        </script>
        @yield('extra-js')
</body>

</html>
