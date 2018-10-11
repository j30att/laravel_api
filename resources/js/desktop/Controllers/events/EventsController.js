class EventsController {
    constructor($scope, $element, EventsResourceService) {
        this.$scope = $scope;
        this.$element = $element;
        this.EventsResourceService = EventsResourceService;
       
        this._opts = {dataLoad: false};

        this.events = [];
        this.filters = {};
        this.activeFilter = {};

        this.getEvents();
        this.getFilters();
    }

    $onInit(){
        this.$element.find('input').on('keydown', function(ev) {
            ev.stopPropagation();
        });
    }

    setFilter(param) {

    }

    getFilters() {
        this.EventsResourceService.getFilters(this.activeFilter)
            .then(response => {
                this.filters = response.data.data;
                this._opts.dataLoad = true;
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

EventsController.$inject = ['$scope', '$element', 'EventsResourceService'];

export {EventsController};
