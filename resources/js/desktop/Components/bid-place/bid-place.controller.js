import {EVENTS_API, SALE_ACTIVE, SUBEVENTS_INDEX} from "../../../common/Constants";


class BidPlace {
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
        this.$scope.$on('sidenav-open', (event, data) => {
            console.log(11212);
            this.buildToggler('right');
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

BidPlace.$inject = ['$scope', 'SalesResourceService', '$mdSidenav', '$http', 'SalesService', '$timeout', '$state'];

export const BidPlaceComponent = {
    bindings: {
        sale: '='
    },
    template: require('./bid-place.template.html'),
    controller: BidPlace,
    controllerAs: '$ctrl'
};
