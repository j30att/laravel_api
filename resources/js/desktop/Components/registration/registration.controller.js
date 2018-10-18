
class Registration {
    constructor($scope,SalesResourceService, $mdSidenav, $http, SalesService, $timeout, $state) {
        this.$mdSidenav = $mdSidenav;
        this.$timeout=$timeout;
        this.$state = $state;
        this.$scope = $scope;
        this.$http = $http;
        this._opts = {fixed: false};
        this.isSidenavOpen =false;
        this.user = null;
        this.prevState = null;
    }

    $onInit(){
        this.$scope.$on('sidenav-registration-open', (event, data) => {
            this.state = data.state;
            this.buildToggler('right_registration');
        });

        this.$scope.$watch('isSidenavOpen', (fixed) => {
            this.$state.modalOpened = fixed
        });



    }

    changeState(state){
        this.prevState = this.state;
        this.state = state;
    }

    goBack(){
        if (this.prevState == null) this.buildToggler('right_registration');
        this.state = this.prevState;
    }

    buildToggler(componentId) {
        this.$mdSidenav(componentId).toggle();
    }

    close(componentId){
        this.$mdSidenav(componentId).close();
    }

    secondStep(){
        this.state = 'register_password';
    }
    thirdStep(){
        this.state = 'confirm_privacy';
    }

};

Registration.$inject = ['$scope', 'SalesResourceService', '$mdSidenav', '$http', 'SalesService', '$timeout', '$state'];

export const RegistrationComponent = {
    bindings: {

    },
    template: require('./registration.template.html'),
    controller: Registration,
    controllerAs: '$ctrl'
};
