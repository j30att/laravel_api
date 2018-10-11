class EventsDetailController {
    constructor($scope, $element, EventsResourceService) {
        this.$scope = $scope;
        this.$element = $element;
        this.EventsResourceService = EventsResourceService;
       
        this._opts = {dataLoad: false};

        this.events = [];
        this.filters = {};
        this.activeFilter = {};

        this.getEvents();
    }

    $onInit(){
        this.$element.find('input').on('keydown', function(ev) {
            ev.stopPropagation();
        });
    }

    toggleSidenav() {
        this.$scope.$broadcast('sidenav-open', () =>{
            console.log('open sidenav')
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

EventsDetailController.$inject = ['$scope', '$element', 'EventsResourceService'];

export {EventsDetailController};
