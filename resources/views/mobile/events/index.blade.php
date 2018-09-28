@extends('layouts.main')

@section('content')


    <div class="row" ng-controller="EventsController as EvntsCtrl">
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


                <events-carousel ng-if="EvntsCtrl._opts.dataLoad"
                        events="EvntsCtrl.events" state="row"></events-carousel>

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

                    @include($_typeDevice.'.bids.parts.bid')
                    @include($_typeDevice.'.bids.parts.bid')
                    @include($_typeDevice.'.bids.parts.bid')
                    @include($_typeDevice.'.bids.parts.bid')
                    @include($_typeDevice.'.bids.parts.bid')



                </div>



                @include($_typeDevice.'.partial.footer-binds')

            </div>

        </div>
@endsection

