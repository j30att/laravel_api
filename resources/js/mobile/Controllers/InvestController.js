class InvestController {
    constructor($window, $http, EventsResourceService, SalesResourceService) {
        this.$window = $window;
        this.$http = $http;
        this.EventsResourceService = EventsResourceService;
        this.SalesResourceService = SalesResourceService;

        this.filter = 'closing';
        this.events = [];
        this.sales = [];
        this._opts = {
            dataLoad: false
        };
    }

    $onInit() {
        this.getEventsList();
        this.setFilter(this.filter);
    }

    setFilter(param) {
        let possibles = ['closing','markup'];

        if(possibles.includes(param)){
            this.filter = param;
            this.getSales();
        }
    }

    getEventsList() {
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

InvestController.$inject = ['$window', '$http', 'EventsResourceService', 'SalesResourceService'];

export {InvestController};