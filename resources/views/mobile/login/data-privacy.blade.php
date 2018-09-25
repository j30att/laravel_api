@extends('layouts.main')

@section('content')


    <div class="row">
        <div class="personal_inform col-md-12">
        <div class="personal_inform__title ">
            <a href="{{route('signin')}}"><div class="goback"></div></a>
            Privacy
        </div>


                <div class="data-privacy">
                    <span>Data & Privacy</span>
                    To esure your expirience is personal and relevant, we’re changing the type of advert you see and giving your more control over your data
                </div>
                <div class="check-box-wr">
                    <div class="check-box__email">
                        <input type="checkbox" id="sms_new" checked>
                        <label for="sms_new">Yes, I’d like to hear about the latest poker news and promotions by Email</label>

                    </div>
                    <div class="check-box__email">
                        <input type="checkbox" id="email_new" checked>
                        <label for="email_new">Yes, I’d like to hear about the latest poker news and promotions by SMS</label>

                    </div>
                </div>
                <input id='termconfirm' type="submit" name="submit_confirm" value="Confirm" style="border-radius:10pt;">



            <div class="see_policy">
                <a href="{{route('privacy')}}">See Privacy policy</a>
            </div>


        </div>
    </div>
@endsection

