class MainMenuController {
    constructor($state, $scope, $mdDialog, $http) {
        this.$http = $http;
        this.$scope = $scope;
        this.url = $state.current.url;
        this.$state = $state;
        this.$mdDialog = $mdDialog;
        this.user = window.__user;
    }


    toggleSidenavProfile() {
        this.$scope.$broadcast('sidenav-profile-open', () => {
        });
    }

    toggleSidenavLogin() {
        this.$scope.$broadcast('sidenav-login-open', () => {
        });
    }

    toggleSidenavRegistration(state) {
        this.$scope.$broadcast('sidenav-registration-open', {state});
    }


    isActive(string) {
        if (this.url.indexOf(string) === 1) {
            return {active: true}
        }
        return null
    }

    showLogoutPopUp() {
        let confirm = this.$mdDialog.confirm()
            .title('Log out')
            .textContent('Do you want to log out? Don’t do it, if you are not sure. Thanks!')
            .ok('Log Out')
            .cancel('Cancel');

        this.$mdDialog.show(confirm).then(() => {
            window.location.href = '/logout';
            //self.$state.go('logout');
        }, () => {
        });
    }
    testUser(){
        console.log(this);
    }

}

MainMenuController.$inject = ['$state', '$scope', '$mdDialog', '$http'];

export const MainMenuComponent = {
    bindings: {
        state: '<',
    },
    template: require('./main-menu.template.html'),
    controller: MainMenuController,
    controllerAs: '$ctrl'
};
