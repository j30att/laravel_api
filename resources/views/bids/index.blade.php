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
        
        
       <div class="footer_binds">
            <div class="footer_binds__item item_invest"><div class="footer_binds__img"><img src="/images/g@3x_INVEST.png" alt=""></div>invest</div>
            <div class="footer_binds__item item_invest_bids"><div class="footer_binds__img"><img src="/images/b@3x_BIDS.png" alt=""></div>bids</div>
            <div class="footer_binds__item item_invest_sale"><div class="footer_binds__img"><img src="/images/g_2@3x_SALE.png" alt=""></div>sale</div>
            <div class="footer_binds__item item_invest_wallet"><div class="footer_binds__img"><img src="/images/g_3@3x_WALLET.png" alt=""></div>wallet</div>
        </div>
    </div>
    
    </div>
@endsection

