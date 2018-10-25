<!doctype html>
<html lang="{{ app()->getLocale() }}" ng-app="poker" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0 minimal-ui" />
        <link href="{{ asset('/css/'.$_typeDevice.'/app.css') }}?r={{rand(1000, 10000)}}" rel="stylesheet">
    @if($_platform == 'iOS')
        <link href="{{ asset('/css/'.$_typeDevice.'/ios/ios.css') }}?r={{rand(1000, 10000)}}" rel="stylesheet">
    @endif
        <script src="{{ asset('js/'.$_typeDevice.'/app.js') }}?r={{rand(1000, 10000)}}" type="text/javascript"></script>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <title>Poker</title>
    <script>
        window.__user = {!! json_encode(\Illuminate\Support\Facades\Auth::user()) !!};
    </script>
</head>
<body ng-controller="MainController as MainCtrl"  ng-class="{'': MainCtrl.$state.modalOpened == true}">

<div class="flex-center position-ref full-height container">
    <ui-view>

    </ui-view>
</div>


</body>
</html>
