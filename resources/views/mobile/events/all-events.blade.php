@extends('layouts.main')

@section('content')



    <div class="row" ng-controller="EventsListController as EvntsLstCtrl">
        <div class="binds event-list-main-wr">
            <div class="col-md-12">
                <div class="logo_img">
                    LOGO
                    <img src="/" alt="">
                </div>
            </div>
            <div class="all_events-wr">
                @foreach($events as $event)
                    @include($_typeDevice.'.events.parts.event-list', ['event' => $event])
                @endforeach
            </div>
        </div>
        @include($_typeDevice.'.partial.footer-binds')

    </div>
    <script>
        window.events = {!! $events !!};
    </script>
@endsection

