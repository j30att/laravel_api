@extends('layouts.main')

@section('content')


    <div class="row" ng-controller="RegisterController as RgCtrl">
        <div class="personal_inform col-md-12">
        <div class="personal_inform__title ">
            <a href="{{route('signin')}}"><div class="goback"></div></a>

            Registration
        </div>

            <div action="#" class="form_personal_inf">
                <input type="text"  placeholder="Your name" ng-model="RgCtrl.userName"  required>
                <input type="text"  placeholder="Your e-mail" ng-model="RgCtrl.userEmail" required>
                <input type="text"  placeholder="Your age" ng-model="RgCtrl.userAge" required>
                <input type="password"  placeholder="Your password" ng-model="RgCtrl.userPassword" required>
                <input type="password"  placeholder="Confirm password"  ng-model="RgCtrl.passwordConfirmation" required>
                <div  style="border-radius:10pt;" ng-click="RgCtrl.sendRegisterForm()">continue</div>
            </div>
            <div class="private_policy">
                By creating an account you agree to our
                <a href="{{route('terms')}}">Terms & Conditions</a> and  <a href="{{route('privacy')}}">Privacy Policy</a>
            </div>
        </div>
    </div>
@endsection

