import {LOGIN_URL} from "../Constants";

class LoginController {
    constructor($window, $http) {
        this.$window = $window;
        this.$http = $http;

        this.userEmail = '';
        this.userPassword = '';
        this.busy = false;
        this.error = false;
    }

    onChange() {
        this.error = false;
    }

    sendAuthData($event) {
        $event.stopImmediatePropagation();
        $event.preventDefault();

        if (this.busy) {
            return false;
        }
        this.busy = true;

        let data = {
            email: this.userEmail,
            password: this.userPassword
        };

        this.$http.post(LOGIN_URL, data)
            .then((response) => {
                if (response.status === 200) {
                    this.$window.location.href = '/'
                } else {
                    this.error = 'Incorrect login or password';
                }
            })
            .catch((error) => {
                //console.log(error);
                this.error = 'Incorrect login or password';
            })
            .finally(() => {
                this.busy = false;
            })

    }
}

LoginController.$inject = ['$window', '$http'];

export {LoginController};
