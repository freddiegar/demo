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

            @yield('content')

        </div>
        <script src="{{ url('js/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/helpers.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/app.js') }}" type="text/javascript"></script>

        @stack('scripts')

    </body>
</html>