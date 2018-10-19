class EventsListController {
    constructor($window, EventsResourceService){
        this.$window = $window;
        this.EventsResourceService = EventsResourceService;
        this.opened = [] ;
        this._opts = {dataLoad: false};
        this.showList()
    }

    showList() {
        this.EventsResourceService.getEvents().then(response => {
            this.events = response.data.data;
            this._opts.dataLoad = true;
        });
    }
}

EventsListController.$inject = ['$window', 'EventsResourceService'];

export {EventsListController};
