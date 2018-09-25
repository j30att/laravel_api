@extends($_typeDevice.'.layouts.main')

@section('content')


    <div class="row" ng-controller="LoginController as LgnCtrl">
        <div class="personal_inform col-md-12">
        <div class="personal_inform__title ">
            Add personal information
        </div>
            <div action="#" class="form_personal_inf">
                <input type="text" name="first_name" placeholder="First name" ng-model="LgnCtrl.firstName"  required>
                <input type="text" name="last_name" placeholder="Last name" required>
                <input type="text" name="date_birth" placeholder="Date of Birth" required>
                <input type="text" name="location" placeholder="Location" required>
                <div  style="border-radius:10pt;" ng-click="LgnCtrl.showName()">continue</div>
            </div>
            <div class="private_policy">
                By creating an account you agree to our
                <a href="#">Terms & Conditions</a> and  <a href="#">Privacy Policy</a>
            </div>
        </div>
    </div>
@endsection

