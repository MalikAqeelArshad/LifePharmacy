<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Internal CSS -->
    @stack('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart.index') }}">
                                    Cart <span class="badge badge-secondary badge-pill">{{ Cart::count() }}</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="javascript:;" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (auth()->user()->role == 'admin')
                                    <a class="dropdown-item" href="{{ route('orders.index') }}">Orders</a>
                                    <a class="dropdown-item" href="{{ route('products.index') }}">Products</a>
                                    <hr class="dropdown-divider">
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- jQuery Library -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- App Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Laravel Ajax Script -->
    <script type="text/javascript">
        /* Laravel Ajax Call for Bootsrap Modal */
        $(document).on('click', '.dynamic-modal', function () {
            var $modal = $($(this).data('target'));
            var action = $(this).data('action') || $(this).closest('form').attr('action');
            var modal_action = $modal.find('form').attr('action');
            if(! modal_action || modal_action != action) { $modal.find('form').attr('action',action); }
            if($(this).data('target') && ! $modal.find('#dynamic-content').length) { return false; }
            /* Ajax Call Function */
            $.ajax({
                type: "GET",
                url: action,
                data: data,
                dataType: "html",
                success: function (data) {
                    // console.log(data);
                    $modal.find('#dynamic-content').removeClass('p-5').html(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    $modal.find('#dynamic-content').addClass('p-5').html(errorThrown);
                }
            });
        });
    </script>

    <!-- Internal JS -->
    @stack('scripts')
</body>
</html>
