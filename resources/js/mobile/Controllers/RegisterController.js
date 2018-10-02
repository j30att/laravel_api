import {REGISTER_URL} from "../Constants";

class RegisterController {
    constructor($window, $http){
        this.$window = $window;
        this.$http = $http;
        this.userName ='';
        this.userEmail ='';
        this.userPassword ='';
        this.passwordConfirmation ='';
        this.userAge ='';
    }



    sendRegisterForm(e){
        e.stopPropagation();
        e.preventDefault();

        let data ={
            name:this.userName,
            email: this.userEmail,
            password: this.userPassword,
            password_confirmation : this.passwordConfirmation,
            age: this.userAge
        };
        this.$http.post(REGISTER_URL, data).then(function (response) {

            if (response.status === 200){
                window.location.href = '/';

            } else {
                console.log('валидация не прошла')
            }

        })

    }


};

RegisterController.$inject = ['$window', '$http'];

export {RegisterController};
