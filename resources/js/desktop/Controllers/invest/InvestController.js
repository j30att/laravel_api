import {DialogController} from "../DialogController";
import {SALE_CLOSED, SALE_INDEX, SALE_MARKUP} from "../../Constants"

class InvestController {
    constructor($window, $http, $mdDialog, EventsResourceService, SalesResourceService, $scope) {
        this.EventsResourceService = EventsResourceService;
        this.SalesResourceService = SalesResourceService;
        this.user = window.__user;
        this.$mdDialog = $mdDialog;
        this.$window = $window;
        this.$scope = $scope;
        this.$http = $http;

        this._opts = {dataLoad: false};

        this.events = [];
        this.sales = [];
        this.filter = SALE_CLOSED;

        this.getEvents();

        if(this.user){
            this.getSales(this.user.id);
        } else {
            this.getSales()
        }
    }

    $onInit(){
        this.$scope.$on('place-a-bid', (event, data) => {
            if(data.status === 2){
                this.sales = this.sales.filter(item => item.id !== data.id);
            }
        });
    }

    setFilter(param) {
        if (param === 'closed') {
            this.filter = SALE_CLOSED;
            this.getSales()
        }
        if (param === 'markup') {
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

    getSales(user_id) {
        this.SalesResourceService.getClosingSoonSales(user_id)
            .then(response => {
                this.sales = response.data.data;
                this._opts.dataLoad = true;
            });
    }

    toggleSidenav(index) {
        this.sale = this.sales[index];
        this.$scope.$broadcast('sidenav-open', () =>{
            console.log('open sidenav')
        });
    }

}

InvestController.$inject = ['$window', '$http', '$mdDialog','EventsResourceService','SalesResourceService', '$scope'];

export {InvestController};
