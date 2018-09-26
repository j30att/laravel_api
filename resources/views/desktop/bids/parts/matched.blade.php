@extends('layouts.main')

@section('content')


    <div class="row">
        <div class="binds">
        
        <div class="tabs-wr">
            <div class="active_status col-md-12">
                Bids
            </div>
        <div class="tabs-wr__title col-md-12">
                    <div class="tabs_item tabs_item__active">Matched</div>
                    <div class="tabs_item">Unmatched</div>
                    <div class="tabs_item">Settled</div>
                    <div class="tabs_item">Canceled</div>
                </div>
                <div class="slider_container slider_container__full">
                <div class="swipe-wr full_sc">

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

