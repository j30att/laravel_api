@extends('layouts.main')

@section('content')


    <div class="row">
        <div class="personal_inform col-md-12">
        <div class="personal_inform__title ">
            Add account information
        </div>
            <form action="#" class="form_personal_inf">
                <input type="text" name="email" placeholder="Email" required>
                <input type="text" name="password" placeholder="Password" required>
                <input type="text" name="confirm_pass" placeholder="Confirm password" required>

                <input type="submit" name="submit" value="Continue" style="border-radius:10pt;">
            </form>
            <div class="private_policy">
                By creating an account you agree to our
                <a href="#">Terms & Conditions</a> and  <a href="#">Privacy Policy</a>
            </div>
        </div>
    </div>
@endsection

