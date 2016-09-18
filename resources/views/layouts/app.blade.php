<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PlaceToPay - @yield('title')</title>
        <!-- Styles -->
        <link href="{{ url('css/app.css') }}" rel="stylesheet" type="text/css">
        @stack('styles')

    </head>
    <body>
        <div class="container-fluid">

            <!-- Static navbar -->
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="https://github.com/freddiegar/demo">Demo</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ url('/transaction/index') }}">Compra</a></li>
                            <li><a href="{{ url('/country/index') }}">Paises</a></li>
                        </ul>
                  </div>
                </div>
            </nav>
            <div id="message" name="message" class="hidden alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p id="alert" name="alert" class="text-center" />
            </div>

            @yield('content')

        </div>
        <script src="{{ url('js/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/helpers.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/app.js') }}" type="text/javascript"></script>

        @stack('scripts')

    </body>
</html>