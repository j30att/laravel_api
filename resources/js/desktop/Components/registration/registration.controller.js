
class Registration {
    constructor($scope,SalesResourceService, $mdSidenav, $http, SalesService, $timeout, $state) {
        this.$mdSidenav = $mdSidenav;
        this.$timeout=$timeout;
        this.$state = $state;
        this.$scope = $scope;
        this.$http = $http;
        this.user = window.__user;
        this._opts = {fixed: false};
        this.isSidenavOpen =false;
        this.state = 1;
        this.selectedItem = undefined;
        console.log('registration');



    }
    $onInit(){
        this.$scope.$on('sidenav-registration-open', (event, data) => {

            this.buildToggler('right_registration');
        });

        this.$scope.$watch('isSidenavOpen', (fixed) => {
            this.$state.modalOpened = fixed
        });

    }

    buildToggler(componentId) {
        this.$mdSidenav(componentId).toggle();
    }


    close(componentId){
        this.$mdSidenav(componentId).close();
    }

    secondStep(){
        this.state = 2;
    }
    thirdStep(){
        this.state = 3;
    }


    getSelectedText(){
        if (this.selectedItem !== undefined) {
            return this.selectedItem;
        } else {
            return "Please select your location";
        }
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
