@extends('layouts.main')

@section('content')


    <div class="row" ng-controller="LoginController as LgCtrl">
        <div class="personal_inform col-md-12">
            <div class="personal_inform__title ">
                <a href="{{route('signin')}}"><div class="goback"></div></a>
                Please Login
            </div>
            <div action="#" class="form_personal_inf">

                <input type="text"  placeholder="Your e-mail" ng-model="LgCtrl.userEmail" required>

                <input type="password"  placeholder="Your password" ng-model="LgCtrl.userPassword" required>

                <div  style="border-radius:10pt;" ng-click="LgCtrl.sendAuthData()">Enter</div>
            </div>

        </div>
    </div>
@endsection

