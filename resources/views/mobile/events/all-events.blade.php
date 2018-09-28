@extends('layouts.static')

@section('content')



    <div class="row" ng-controller="EventsController as EvntsCtrl">
        <div class="binds event-list-main-wr">
            <div class="col-md-12">
                <div class="logo_img">
                    LOGO
                    <img src="/" alt="">
                </div>
            </div>
            <div class="all_events-wr">

                <events class="events_list" ng-if="EvntsCtrl._opts.dataLoad"
                        events="EvntsCtrl.events" state="'list'">
                </events>

            </div>
        </div>
        @include($_typeDevice.'.partial.footer-binds')

    </div>
    <script>
        window.events = {!! $events !!};
    </script>
@endsection

