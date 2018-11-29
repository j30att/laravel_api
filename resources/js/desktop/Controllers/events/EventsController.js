class EventsController {
    constructor($state, $scope, $element, $location, EventsResourceService) {
        this.$state = $state;
        this.$scope = $scope;
        this.$element = $element;
        this.$location = $location;
        this.EventsResourceService = EventsResourceService;

        this._opts = {dataLoad: false};

        this.events = [];
        this.filters = {};
        this.activeFilter = {};
        this.getFilters();
    }

    $onInit() {
        this.$element.find('input').on('keydown', function (ev) {
            ev.stopPropagation();
        });
    }

    setFilter(clear = false) {
        if (!clear) {
            this.$state.go('events', this.activeFilter)
        } else {
            this.$state.go('events', {
                date: null,
                event: null,
                country: null,
                venue: null
            })
        }
    };

    disableFilter(type, index) {
        if (type) {
            if (this.activeFilter[type][index]) {
                this.activeFilter[type].splice(index, 1);
                this.setFilter();
            }
        } else {
            this.activeFilter = {};
            this.setFilter(true);
        }
    }

    isSetActiveFilters() {
        let date, event, country, venue;

        if (this.activeFilter.date) {
            date = true;
        }

        if (this.activeFilter.event && this.activeFilter.event.length > 0) {
            event = true;
        }

        if (this.activeFilter.country && this.activeFilter.country.length > 0) {
            country = true;
        }

        if (this.activeFilter.venue) {
            venue = true;
        }

        return date || event || country || venue;
    }

    applyFilters() {
        let {date, event, country, venue} = this.$state.params;

        if (typeof date !== 'undefined') {
            this.activeFilter.date = date;
        }

        if (typeof event !== 'undefined') {
            this.activeFilter.event = typeof event === 'string' ? [event] : event;
        }

        if (typeof country !== 'undefined') {
            this.activeFilter.country = typeof country === 'string' ? [country] : country;
        }

        if (typeof venue !== 'undefined') {
            this.activeFilter.venue = venue;
        }

        this.getEvents();
    }

    getFilters() {
        this.EventsResourceService.getFilters(this.activeFilter)
            .then(response => {
                this.filters = response.data.data;
                this._opts.dataLoad = true;
                this.applyFilters();
            });
    }

    getEvents() {
        this.EventsResourceService.getFilteredEvents(this.activeFilter)
            .then(response => {
                this.events = response.data.data;
                this._opts.dataLoad = true;
            });
    }


}

EventsController.$inject = ['$state', '$scope', '$element', '$location', 'EventsResourceService'];

export {EventsController};
