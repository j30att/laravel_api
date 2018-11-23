class EventsFilterController {
    constructor(EventsResourceService) {
        this.EventsResourceService = EventsResourceService;
        this.state = 'none';
        this.filters = {};

        this.activeFilters = {
            'event': [],
            'country': [],
            'venue': []
        };

        this.titles = {
            none: 'Filter',
            event: 'Choose events',
            country: 'Choose regions',
            venue: 'Choose venues'
        }
    }

    $onInit() {
        this.getFilters();
    }

    getFilters() {
        this.EventsResourceService.getFilters(this.activeFilters)
            .then(response => {
                this.filters = response.data.data;
            });
    }

    setFilter(filterName, id) {
        const index = this.activeFilters[filterName].indexOf(id);
        if (index >= 0) {
            this.activeFilters[filterName].splice(index, 1);
        } else {
            this.activeFilters[filterName].push(id);
        }
    }

    isSetFilter(filterName) {
        const activeFilter = this.activeFilters[filterName],
            values = this.filters[filterName].options;

        if (activeFilter.length > 0) {
            return Object.keys(values)
                .filter((key) => {
                    return activeFilter.indexOf(key) >= 0
                }).reduce((obj, key) => {
                    obj[key] = values[key];
                    return obj;
                }, {})
        }

        return false;
    }

    applyFilters() {
        this.EventsResourceService.getFilteredEvents(this.activeFilters)
            .then(response => {
                this.events = response.data.data;
                this.show = false;
            });
    }

    clearFilters() {
        this.activeFilters = {
            'event': [],
            'country': [],
            'venue': []
        };

        this.EventsResourceService.getFilteredEvents(this.activeFilters)
            .then(response => {
                this.events = response.data.data;
                this.show = false;
            });
    }
}

EventsFilterController.$inject = ['EventsResourceService'];

export const EventsFilterComponent = {
    bindings: {
        events: '=',
        show: '='
    },
    template: require('./events-filter.template.html'),
    controller: EventsFilterController,
    controllerAs: '$ctrl'
};
