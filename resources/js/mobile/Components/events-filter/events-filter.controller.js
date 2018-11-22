class EventsFilterController {
    constructor(EventsResourceService) {
        this.EventsResourceService = EventsResourceService;
        this.state = 'none';
        this.filters = {};
        this.activeFilter = {};
        this.titles = {
            none: 'Filter',
            events: 'Choose events',
            regions: 'Choose regions',
            venues: 'Choose venues'
        }
    }

    $onInit() {
        this.getFilters();
    }

    getFilters() {
        this.EventsResourceService.getFilters(this.activeFilter)
            .then(response => {
                this.filters = response.data.data;
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
