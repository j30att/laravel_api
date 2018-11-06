
class LogDetails {
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



    $onInit(){
        this.$scope.$on('sidenav-logDetails-open', (event, data) => {
            this.buildToggler('right_log_details');
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





};

LogDetails.$inject = ['$scope', 'SalesResourceService',
    '$mdSidenav', '$http', 'SalesService', '$timeout', '$state', 'DealerResourceService', '$mdDialog'];

export const LogDetailsComponent = {
    bindings: {

    },
    template: require('./log_details.template.html'),
    controller: LogDetails,
    controllerAs: '$ctrl'
};
