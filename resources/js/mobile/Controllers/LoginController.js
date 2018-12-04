import {LOGIN_URL} from "../Constants";
import {FORGOT_URL, RESEND_CONFIRM_URL, RESET_URL} from "../../common/Constants";

class LoginController {
    constructor($window, $http, $stateParams){
        this.$window = $window;
        this.$http = $http;
        this.firstName = '';
        this.state = 'login';
        this.$stateParams = $stateParams;
        this.notConfirmed = {status: false, text: ''};

    }

    $onInit(){
        if(this.$stateParams.restore == 1){
            this.state = 'create_password';
        }
    }

    sendAuthData(e) {
        console.log(123);
        e.stopPropagation();
        e.preventDefault();
        let data = {
            email : this.userEmail,
            password : this.userPassword
        };

        this.$http.post(LOGIN_URL, data).then(
            (response) => {
            if (response.data.status == 0){
                this.notConfirmed.status = true;
                this.notConfirmed.text = response.data.msg;
                this.state = 'no_confirm_email';
            } else{
                window.location.href = '/invest'
            }
        })

    }
    resendConfirm(){
        let data = {
            email: this.userEmail,
        };
        this.$http.post(RESEND_CONFIRM_URL, data).then((response)=>{
            this.notConfirmed.text = response.data.msg;
        })
    }

    forgotPassword(){
        this.state = 'forgot';

    }

    resetMail(e) {
        e.stopPropagation();
        e.preventDefault();
        let email = this.userEmailForgot;
        this.$http.post(FORGOT_URL, {email:email}).then((response) => {
            if(response.data.status == 1){
                this.state = 'check_inbox';
            }
        });
    }

    resetPassword(e){
        e.stopPropagation();
        e.preventDefault();
        if (this.createNewPassword === this.createNewPasswordConfirm){
            let password =  this.createNewPassword;
            let email    = this.confirmEmail;
            let password_confirmation = this.createNewPasswordConfirm;

            this.$http.post(RESET_URL, {email:email, password:password, password_confirmation:password_confirmation}).then((response) =>{
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

LoginController.$inject = ['$window', '$http', '$stateParams'];

export {LoginController};
