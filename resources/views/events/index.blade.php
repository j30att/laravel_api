@extends('layouts.main')

@section('content')


    <div class="row">
        <div class="col-md-12 binds">
            <div class="logo_img">
                LOGO
                <img src="/" alt="">
            </div>
            <div class="tabs-wr">
                <div class="tabs-wr__title">
                    <div class="tabs-wr__title-name">Events</div>
                    <div class="see_all"><a href="{{route('all-events')}}">See All</a></div>
                </div>
                <div class="slider_container">

                    <div class="swipe-wr">

                        @foreach($events as $event)
                        @include('events.parts.event')
                        @endforeach



                    </div>

                </div>
                <div class="tabs-wr__title">
                    <div class="tabs-wr__title-name">Players</div>
                    <div class="see_all">See All</div>
                </div>
                <div class="tabs-wr__players">
                    <div class="tabs_players">
                        <div class="tabs_players__closing tabs_item__active">Closing</div>
                        <div class="tabs_players__lower">Lowest markup</div>
                    </div>
                </div>
                <div class="swipe-wr full_sc events_player">

                    @include('bids.parts.tabs')
                    @include('bids.parts.tabs')
                    @include('bids.parts.tabs')
                    @include('bids.parts.tabs')
                    @include('bids.parts.tabs')
                    @include('bids.parts.tabs')
                    @include('bids.parts.tabs')
                    @include('bids.parts.tabs')
                    @include('bids.parts.tabs')

                </div>



                @include('partial.footer-binds')

            </div>

        </div>
@endsection

