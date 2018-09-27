@extends('layouts.main')

@section('content')


    <div class="row" ng-controller="BidResponsesController as BdsRspnsCtrl">
        <div class="col-md-12 binds">
            <div class="logo_img">
                LOGO
                <img src="/" alt="">
            </div>

            <bids-carousel ng-if="BdsRspnsCtrl._opts.dataLoad"
                           bids="BdsRspnsCtrl.bids"
                           menu="BdsRspnsCtrl.menu"
            >

            </bids-carousel>
            @include($_typeDevice.'.partial.footer-binds')
        </div>

    </div>
@endsection

