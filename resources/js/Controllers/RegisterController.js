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

            if (response.data.status === 0){
                console.log('валидация не прошла')
            } else {
                window.location.href = '/'
            }

        })

    }


};

RegisterController.$inject = ['$window', '$http'];

export {RegisterController};
