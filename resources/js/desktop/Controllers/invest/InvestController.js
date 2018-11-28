import {SALE_CLOSED, SALE_INDEX, SALE_MARKUP} from "../../Constants"

class InvestController {
    constructor($window, $http, $mdDialog, EventsResourceService, SalesResourceService, $scope, $stateParams, $state) {
        this.EventsResourceService = EventsResourceService;
        this.SalesResourceService = SalesResourceService;
        this.user = window.__user;
        this.$mdDialog = $mdDialog;
        this.$window = $window;
        this.$scope = $scope;
        this.$http = $http;
        this.$state = $state;
        this.$stateParams = $stateParams;
        this._opts = {dataLoad: false};

        this.events = [];
        this.sales = [];
        this.filter = SALE_CLOSED;
    }

    $onInit() {
        if(this.$state.current.name === 'closing-soon-list'){
            this.getSales();
        } else {
            this.getEvents();
            this.getSales({limit: 10});
        }

        if (this.$stateParams.restore == 1) {
            this.toggleSidenavLogin();
        }

        this.$scope.$on('place-a-bid', (event, data) => {
            if (data.status === 2) {
                this.sales = this.sales.filter(item => item.id !== data.id);
            }
        });
    }


    toggleSidenavLogin() {
        setTimeout(() => {
            this.$scope.$broadcast('sidenav-login-open', {state: 4});
        }, 100);

    }

    setFilter(param) {
        if (param === 'closed') {
            this.filter = SALE_CLOSED;
            this.getSales()
        } else if (param === 'markup') {
            this.filter = SALE_MARKUP;
            this.getSales()
        }
    }

    getEvents() {
        this.EventsResourceService.getMainEvents()
            .then(response => {
                this.events = response.data.data;
                this._opts.dataLoad = true;
            });
    }

    getSales(filter) {
        this.SalesResourceService.getClosingSoonSales(filter)
            .then(response => {
                this.sales = response.data.data;
                this._opts.dataLoad = true;
            });
    }

    toggleSidenav(index) {
        this.sale = this.sales[index];
        this.$scope.$broadcast('sidenav-open', () => {
            console.log('open sidenav')
        });
    }

}

InvestController.$inject = ['$window', '$http', '$mdDialog', 'EventsResourceService', 'SalesResourceService', '$scope', '$stateParams', '$state'];

export {InvestController};
