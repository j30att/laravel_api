class InvestController {
    constructor($window, $http, EventsResourceService, SalesResourceService, $scope, CountriesResourceService) {
        this.$window = $window;
        this.$http = $http;
        this.$scope = $scope;
        this.EventsResourceService = EventsResourceService;
        this.SalesResourceService = SalesResourceService;
        this.CountriesResourceService = CountriesResourceService;


        this.showFilter = false;
        this.events = [];
        this.sales = [];
        this._opts = {
            dataLoad: false
        };
        this.state = 'filters_close';
        this.selectedEvents = [];
        this.selectedCountries = [];
        this.getCountries();

        this.user = window.__user;
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

    // getFullEventList(){
    //     this.EventsResourceService.getAllEvents()
    //         .then(response => {
    //             this.events = response.data.data;
    //             this._opts.dataLoad = true;
    //         });
    // }

    getSales() {
        this.SalesResourceService.getClosingSoonSales()
            .then(response => {
                this.sales = response.data.data;
                this._opts.dataLoad = true;
            });
    }

    getCountries() {
        this.CountriesResourceService.getCountries()
            .then(response => {
                this.countries = response.data.data;
            });
    }


    selectedEvent(item, list) {
        var idx = list.indexOf(item);
        if (idx > -1) {
            list.splice(idx, 1);
        }
        else {
            list.push(item);
        }

    };

    exists(item, list) {
        return list.indexOf(item) > -1;

    };

    selectedCountry(item, list) {
        var idx = list.indexOf(item);
        if (idx > -1) {
            list.splice(idx, 1);
        }
        else {
            list.push(item);
        }
        console.log(this.selectedCountries);

    };

    existsCountry(item, list) {
        return list.indexOf(item) > -1;

    };
    clearAllFilters(){
        this.selectedEvents = [];
        this.selectedCountries = [];
    }

    saveFilters(){
        let filter = {
            events      : this.selectedEvents,
            countries   : this.selectedCountries
        };
        this.EventsResourceService.getFilteredEvents(filter)
        .then(response => {
            this.events = response.data.data;
        });
        this.state = 'filters_close';

    }



}

InvestController.$inject = ['$window', '$http', 'EventsResourceService', 'SalesResourceService',
'$scope', 'CountriesResourceService'];

export {InvestController};
