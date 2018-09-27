@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12 profile-title">
            <a class="profile-back"></a>
            Edit profile
            <a class="profile-save">Save</a>
        </div>
        <div class="profile-photo-small"></div>
        <div class="col-md-12 text-center text-muted">Tap to update</div>

        <div class="profile-field">
            <label for="name">First name</label>
            <input type="text" name="name">
        </div>

        <div class="profile-field">
            <label for="lastname">Last name</label>
            <input type="text" name="lastname">
        </div>
        <div class="profile-field">
            <label for="lastname">Date of Birth</label>
            <input type="text" name="birthdate">
        </div>
        <div class="profile-field">
            <label for="lastname">Location</label>
            <input type="text" name="location">
        </div>
        <div class="profile-field">
            <label for="lastname">Email</label>
            <input type="text" name="email">
        </div>
        <div class="profile-field">
            <label for="lastname">Username</label>
            <input type="text" name="username">
        </div>

    </div>
@endsection

