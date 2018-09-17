@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12 profile-title">
            <a class="profile-close"></a>
            Your profile
        </div>
        <div class="profile-photo"></div>
        <div class="col-md-12 text-center font-weight-bold profile-name">Delia Mathis</div>
        <div class="col-md-12 text-center text-muted">Tap to replace photo</div>
        <button class="btn btn-danger">Link Party Pocker account</button>

        <div class="col-md-12 profile-settings-title">Settings</div>

        <menu class="profile-settings-block">
            <a class="profile-settings-acc">Account info</a>
        </menu>

    </div>
@endsection

