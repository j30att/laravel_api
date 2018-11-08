
class UserDetails {
    constructor($scope,SalesResourceService, $mdSidenav, $http, SalesService,
                $timeout, $state, DealerResourceService, $mdDialog)
    {
        this.SalesResourceService = SalesResourceService;
        this.DealerResourceService = DealerResourceService;
        this.SalesService = SalesService;
        this.$mdSidenav = $mdSidenav;
        this.$mdDialog = $mdDialog;
        this.$timeout=$timeout;
        this.$state = $state;
        this.$scope = $scope;
        this.$http = $http;
        this.user = window.__user;
        this._opts = {fixed: false};
        this.isSidenavOpen =false;


    }

    getSales(id){
        this.DealerResourceService.getSales(id).then(response => {
            this.user = response.data.data[0];

            this.key = 0;
            this.bids = this.user.sales[this.key].bids;
        })
    }


    $onInit(){
        this.$scope.$on('sidenav-userDetails-open', (event, data) => {
            this.getSales(data);

            this.buildToggler('right_user_details');
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

    showBids(key){
        this.key = key;
        this.bids = this.user.sales[this.key].bids;

    }
    eventTitle(key){

        let eventTitle = this.user.sales[this.key].event.title;
        return eventTitle;
    }



};

UserDetails.$inject = ['$scope', 'SalesResourceService',
    '$mdSidenav', '$http', 'SalesService', '$timeout', '$state', 'DealerResourceService', '$mdDialog'];

export const UserDetailsComponent = {
    bindings: {

    },
    template: require('./user_details.template.html'),
    controller: UserDetails,
    controllerAs: '$ctrl'
};
