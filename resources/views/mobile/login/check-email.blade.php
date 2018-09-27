@extends('layouts.main')

@section('content')


    <div class="row">
        <div class="personal_inform col-md-12">
        <div class="personal_inform__title ">

        </div>
            <form action="#" class="form_personal_inf">
                <input type="text" name="check_email" placeholder="jimmy.norris@gmail.com" required style="border: 1px solid rgb(246, 246, 246); background-color: rgb(246, 246, 246);
">
                <div class="check_imfo">
                    <span>Check your email address</span>
                    Pleasecheck your email to  continue or change it on new one
                </div>

                <input type="submit" name="submit_confirm" value="Confirm" style="border-radius:10pt;">
                <div class="change_mail">Change email</div>

            </form>

        </div>
    </div>
@endsection

