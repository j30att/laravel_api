@extends($_typeDevice.'.layouts.main')

@section('content')



    <div class="row" ng-controller="EventsListController as EvntsLstCtrl">
        <div class="col-md-12 binds">
            <div class="selected_event">
                <a href="{{route('events')}}">
                    <div class="goback gb_white"></div>
                </a>
                <div class="open_event"></div>
                <img src="/images/select_event_bg.png" alt="">
            </div>
            <div class="all_events-wr col-md-12">
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

