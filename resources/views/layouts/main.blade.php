<!doctype html>
<html lang="{{ app()->getLocale() }}" ng-app="poker">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('/css/'.$_typeDevice.'/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
        <title>landing</title>
    </head>
    <body>
        <div class="flex-center position-ref full-height container">
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>
