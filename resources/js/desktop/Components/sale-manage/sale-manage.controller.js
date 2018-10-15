import {EVENTS_API, SALE_ACTIVE, SUBEVENTS_INDEX} from "../../../common/Constants";


class SaleManage {
    constructor($scope, SalesResourceService, $mdSidenav, $http, SalesService, $timeout, $state) {
        this.SalesResourceService = SalesResourceService;
        this.SalesService = SalesService;
        this.$mdSidenav = $mdSidenav;
        this.$timeout = $timeout;
        this.$state = $state;
        this.$scope = $scope;
        this.$http = $http;
        this.user = window.__user;
        this._opts = {fixed: false};
        this.isSidenavOpen = false;

        this.sale = {};

    }

    $onInit() {
        this.$scope.$on('sidenavManage-open', (event, data) => {
            if (data) {
                this.sale = data;
                console.log(this.sale);
                this.buildToggler('right_manage');
            }
        });
        this.$scope.$watch('isSidenavOpen', (fixed) => {
            this.$state.modalOpened = fixed
        });

    }

    buildToggler(componentId) {
        this.$mdSidenav(componentId).toggle();
        if (this.$mdSidenav(componentId).isOpen()) {
            this.$state.modalOpened = true;
        } else {
            this.$state.modalOpened = false
        }
    }


    close(componentId) {
        this.$mdSidenav(componentId).close();
    }

}

SaleManage.$inject = ['$scope', 'SalesResourceService', '$mdSidenav', '$http', 'SalesService', '$timeout', '$state'];

export const SaleManageComponent = {
    bindings: {},
    template: require('./sale-manage.template.html'),
    controller: SaleManage,
    controllerAs: '$ctrl'
};
