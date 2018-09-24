import {LOGIN_URL} from "../Constants";

class LoginController {
    constructor($window, $http){
        this.$window = $window;
        this.$http = $http;

    }

    showLoginForm(){

        window.location.href = '/login/personal-information';
    }







};

LoginController.$inject = ['$window', '$http'];

export {LoginController};
