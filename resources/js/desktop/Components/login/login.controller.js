import {LOGIN_URL} from "../../../common/Constants";

class Login {
    constructor($scope, SalesResourceService, $mdSidenav, $http, SalesService, $timeout, $state) {
        this.$mdSidenav = $mdSidenav;
        this.$timeout = $timeout;
        this.$state = $state;
        this.$scope = $scope;
        this.$http = $http;

        this.user = window.__user;
        this._opts = {fixed: false};
        this.isSidenavOpen = false;
        this.state = 1;

        this.userEmail = null;
        this.userPassword = null;
    }

    $onInit() {
        this.$scope.$on('sidenav-login-open', (event, data) => {

            this.buildToggler('right_login');
        });

        this.$scope.$watch('isSidenavOpen', (fixed) => {
            this.$state.modalOpened = fixed
        });

    }

    buildToggler(componentId) {
        this.$mdSidenav(componentId).toggle();
    }


    close(componentId) {
        this.$mdSidenav(componentId).close();
    }

    forgotPassword() {
        this.state = 2;
    }

    resetMail() {
        this.state = 3;
    }

    backToLogin() {
        this.state = 1;
    }

    sendAuthData(e) {
        e.stopPropagation();
        e.preventDefault();
        let data = {
            email: this.userEmail,
            password: this.userPassword
        };

        this.$http.post(LOGIN_URL, data)
            .then(function (response) {
                if (response.status === 200) {
                    window.location.href = '/'
                }
            })

    }
}

Login.$inject = ['$scope', 'SalesResourceService', '$mdSidenav', '$http', 'SalesService', '$timeout', '$state'];

export const LoginComponent = {
    bindings: {},
    template: require('./login.template.html'),
    controller: Login,
    controllerAs: '$ctrl'
};
