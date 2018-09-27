@extends('layouts.main')

@section('content')


    <div class="row" ng-controller="FilterBidResponsesController as FltrBdsRspnsCtrl">
        <div class="binds binds_full_sc">

            <div class="tabs-wr">
                <div class="active_status col-md-12">
                    Bids
                </div>
                <div class="tabs-wr__title col-md-12">
                    <div class="tabs_item"
                         ng-class="{'tabs_item__active':FltrBdsRspnsCtrl.filter === menuItem.status}"
                         ng-repeat="menuItem in FltrBdsRspnsCtrl.menu"
                         ng-bind="menuItem.name"
                         ng-click="FltrBdsRspnsCtrl.setFilter(menuItem.status)">
                    </div>

                </div>
                <div class="slider_container slider_container__full">
                    <div class="swipe-wr full_sc">
                        <bids-row class="bids_row__fullscreen" bids="FltrBdsRspnsCtrl.bids"></bids-row>
                    </div>
                </div>
            </div>


            <div class="footer_binds">
                <div class="footer_binds__item item_invest">
                    <div class="footer_binds__img"><img src="/images/g@3x_INVEST.png" alt=""></div>
                    invest
                </div>
                <div class="footer_binds__item item_invest_bids">
                    <div class="footer_binds__img"><img src="/images/b@3x_BIDS.png" alt=""></div>
                    bids
                </div>
                <div class="footer_binds__item item_invest_sale">
                    <div class="footer_binds__img"><img src="/images/g_2@3x_SALE.png" alt=""></div>
                    sale
                </div>
                <div class="footer_binds__item item_invest_wallet">
                    <div class="footer_binds__img"><img src="/images/g_3@3x_WALLET.png" alt=""></div>
                    wallet
                </div>
            </div>
        </div>

    </div>
@endsection

