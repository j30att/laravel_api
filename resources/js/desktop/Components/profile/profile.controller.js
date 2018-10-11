
class Profile {
    constructor($scope,SalesResourceService, $mdSidenav, $http, SalesService, $timeout, $state) {
        this.SalesResourceService = SalesResourceService;
        this.SalesService = SalesService;
        this.$mdSidenav = $mdSidenav;
        this.$timeout=$timeout;
        this.$state = $state;
        this.$scope = $scope;
        this.$http = $http;
        this.user = window.__user;
        this._opts = {fixed: false};
        this.isSidenavOpen =false;


    }
    $onInit(){
        this.$scope.$on('sidenav-profile-open', (event, data) => {
            console.log(11212);
            this.buildToggler('right_profile');
        });

        this.$scope.$watch('isSidenavOpen', (fixed) => {
            console.log(fixed);
            this.$state.modalOpened = fixed
        });

    }

    buildToggler(componentId) {
        this.$mdSidenav(componentId).toggle();
    }


    close(componentId){
        this.$mdSidenav(componentId).close();
    }

};

Profile.$inject = ['$scope', 'SalesResourceService', '$mdSidenav', '$http', 'SalesService', '$timeout', '$state'];

export const ProfileComponent = {
    bindings: {

    },
    template: require('./profile.template.html'),
    controller: Profile,
    controllerAs: '$ctrl'
};
