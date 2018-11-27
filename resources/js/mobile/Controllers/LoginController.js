import {LOGIN_URL} from "../Constants";
import {FORGOT_URL, RESET_URL} from "../../common/Constants";

class LoginController {
    constructor($window, $http){
        this.$window = $window;
        this.$http = $http;
        this.firstName = '';
        this.state = 'login';


    }

    sendAuthData(e){
        e.stopPropagation();
        e.preventDefault();
        let data = {
            email : this.userEmail,
            password : this.userPassword
        };

        this.$http.post(LOGIN_URL, data).then(function (response) {
            if (response.status === 200){
                window.location.href = '/'
            }
        })

    }

    forgotPassword(){
        this.state = 'forgot';

    }

    resetMail() {
        let email = this.userEmailForgot;
        this.$http.post(FORGOT_URL, {email:email}).then((response) => {
            if(response.data.status == 1){
                this.state = 'check_inbox';
            }
        });
    }

    resetPassword(){
        if (this.codeOfEmail.length > 10 && this.createNewPassword === this.createNewPasswordConfirm){
            let password =  this.createNewPassword;
            let token    = this.codeOfEmail;
            let email    = this.userEmailForgot;
            let password_confirmation = this.createNewPasswordConfirm;

            this.$http.post(RESET_URL, {token:token, email:email, password:password, password_confirmation:password_confirmation}).then((response) =>{
                if(response.data.status == 1){
                    this.state = 'ok_login';
                }
                if(response.data.status == 0){
                    this.state = 'try_again';
                }
            });
        }
    }

}

LoginController.$inject = ['$window', '$http'];

export {LoginController};
