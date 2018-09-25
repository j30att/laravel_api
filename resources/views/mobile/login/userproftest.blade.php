@extends($_typeDevice.'.layouts.main')

@section('content')


    <div class="row" ng-controller="ProfileController as PrCtrl">
        <div class="personal_inform col-md-12">
        <div class="personal_inform__title ">
            user info
        </div>
            <div action="#" class="form_personal_inf">
                <p class="user_name" >user_name</p>
                <input type="text" placeholder="New name" ng-model="PrCtrl.user.name">

                <p class="user_name">user_age</p>
                <input type="text" placeholder="New age" ng-model="PrCtrl.user.age">
                <div  style="border-radius:10pt;" ng-click="PrCtrl.changeProfile()">Change profile</div>
            </div>
            <div class="private_policy">
                By creating an account you agree to our
                <a href="#">Terms & Conditions</a> and  <a href="#">Privacy Policy</a>
            </div>
        </div>
    </div>
    <script>
        window.user = {!! $user !!}
    </script>
@endsection

