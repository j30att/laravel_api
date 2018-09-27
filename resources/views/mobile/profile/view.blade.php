@extends('layouts.main')

@section('content')
    <div class="row" ng-controller="ProfileController as PrCtrl">
        <div class="col-md-12 profile-title">
            <a class="profile-close"></a>
            Your profile {{$user->name}}


        </div>

        <div class="profile-photo"></div>
        <div class="col-md-12 text-center text-muted">Tap to replace photo</div>
        <div class="col-md-12 text-center font-weight-bold profile-name">Milton Jimenez</div>
        <a class="btn-logout" href="{{ route('logout') }}"
          onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>

        <button class="btn btn-danger">Link Party Pocker account</button>

        <div class="col-md-12 profile-settings-title">Settings</div>

        <menu class="profile-settings-block">
            <a class="profile-settings-acc-notification">Notifications and sounds</a>
            <a class="profile-settings-acc-privacy">Privacy and security</a>
            <a class="profile-settings-acc-account">Account info</a>
            <a class="profile-settings-acc-support">Support</a>
            <a class="profile-settings-acc-tell">Tell a friend</a>
            <a class="profile-settings-acc-setting">Settings</a>
        </menu>

    </div>

@endsection

