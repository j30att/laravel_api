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
        this.user == null ? this.getSales() : this.getSales(this.user.id);
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

    getSales() {
        this.SalesResourceService.getClosingSoonSales()
            .then(response => {
                this.sales = response.data.data;
                this._opts.dataLoad = true;
            });
    }
}

InvestController.$inject = ['$window', '$http', '$mdDialog','EventsResourceService','SalesResourceService', '$scope'];

export {InvestController};
