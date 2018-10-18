class EventsDetailController {
    constructor($scope, $state, EventsResourceService) {
        this.$scope = $scope;
        this.$state = $state;
        this.EventsResourceService = EventsResourceService;
        this.event = {};
        this.activeEvent = [];

        this._opts = {dataLoad: false};
    }

    $onInit() {
        this.getEvent();
    }

    toggleSidenav() {
        this.$scope.$broadcast('sidenav-open', () => {
            console.log('open sidenav')
        });
    }

    toggleEvent(event){
        this.activeEvent = event;
    }

    getEvent() {
        let {id} = this.$state.params;

        if (id) {
            this.EventsResourceService.getEventById(id)
                .then(response => {
                    this.event = response.data.data;
                    if(this.event.subevents[0]){
                        this.activeEvent = this.event.subevents[0];
                    } else {
                        this.activeEvent = this.event;
                    }
                    this._opts.dataLoad = true;
                });
        }
    }

}

EventsDetailController.$inject = ['$scope', '$state', 'EventsResourceService'];

export {EventsDetailController};
