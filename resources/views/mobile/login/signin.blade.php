@extends('layouts.main')

@section('content')


    <div class="row" ng-controller="LoginController as LgCtrl">
        <div class="login_page-wr col-md-12">
            <div class="login_block">
                <div class="buy_stakes">
                    Buy stakes in poker players in tournaments online and around the world
                </div>
                <div class="btn_block">
                    <a href="{{route('login')}}">
                        <div class="login_btn login_in">Log in</div>
                    </a>
                    <a href="{{route('register')}}">
                    <div class="login_btn login_registration" >Register</div>
                    </a>
                </div>
                <div class="contine_without">
                    Continue without registration
                </div>
            </div>
        </div>
    </div>
@endsection

