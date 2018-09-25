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
                    <div class="tabs-wr__title-name">Matched bids</div>
                    <div class="see_all">See All</div>
                </div>
                <div class="slider_container">

                <div class="swipe-wr">
                
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

        </div>
        <div class="tabs-wr">
        <div class="tabs-wr__title">
                    <div class="tabs-wr__title-name">Unmatched Bids</div>
                    <div class="see_all">See All</div>
                </div>
                <div class="slider_container">
                <div class="swipe-wr">
                
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
        </div>
        </div>
        <div class="tabs-wr">
        <div class="tabs-wr__title">
                    <div class="tabs-wr__title-name">Settled Bids</div>
                    <div class="see_all">See All</div>
                </div>
                <div class="slider_container">
                <div class="swipe-wr">
                
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
        </div>
        </div>
        <div class="tabs-wr">
        <div class="tabs-wr__title">
                    <div class="tabs-wr__title-name">Cancel Bids</div>
                    <div class="see_all">See All</div>
                </div>
                <div class="slider_container">
                <div class="swipe-wr">
                
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
        </div>
        </div>
        

        @include('partial.footer-binds')

    </div>
    
    </div>
@endsection

