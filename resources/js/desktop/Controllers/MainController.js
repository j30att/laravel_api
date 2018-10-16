class MainController {
    constructor($state, $scope) {
        this.$scope = $scope;
        this.$state = $state;
    };

    toggleSidenavLogin() {
        this.$scope.$broadcast('sidenav-login-open', () =>{
            console.log(12312312312);
        });
    }
    toggleSidenavRegistration() {
        this.$scope.$broadcast('sidenav-registration-open', () =>{
        });
    }

}

MainController.$inject = ['$state', '$scope'];

export {MainController};
