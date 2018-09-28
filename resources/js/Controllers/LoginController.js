import {LOGIN_URL} from "../Constants";

class LoginController {
    constructor($window, $http){
        this.$window = $window;
        this.$http = $http;
        this.firstName ='';

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

};

LoginController.$inject = ['$window', '$http'];

export {LoginController};
