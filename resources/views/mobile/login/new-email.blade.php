@extends($_typeDevice.'.layouts.main')

@section('content')


    <div class="row">
        <div class="personal_inform col-md-12">
        <div class="personal_inform__title ">
            Enter new email
        </div>
            <form action="#" class="form_personal_inf">
                <div class="new-email_imfo">
                    We will send you a cofrimation with a link to confirm your email, please open a link
                </div>

                <input type="text" name="new_email" placeholder="jimmy.norris@gmail.com" required style="border: 1px solid rgb(246, 246, 246); background-color: rgb(246, 246, 246);">


                <input type="submit" name="submit_confirm" value="Confirm" style="border-radius:10pt;">


            </form>

        </div>
    </div>
@endsection

