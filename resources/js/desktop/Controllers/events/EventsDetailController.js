class EventsDetailController {
    constructor($scope, $state, $window, EventsResourceService) {
        this.$scope = $scope;
        this.$state = $state;
        this.$window = $window;
        this.EventsResourceService = EventsResourceService;
        this.event = {};
        this.sale = {};
        this.bid = {};
        this.activeEvent = [];
        this.user = window.__user;
        this._opts = {dataLoad: false};
        this.sub_event_id = null;
        console.log(this.user);
    }

    $onInit() {
        this.getEvent();
    }

    toggleSidenav(sale, bid) {
        this.sale = sale;

        this.bid.markup = bid.markup;
        this.bid.share = bid.share + '%';
        this.bid.amount = '$' + bid.amount;

        this.$scope.$broadcast('sidenav-open', () => {
        });
    }

    toggleSaleSidenav() {
        let data = {
            event:this.event.id,
            sub_event_id: this.sub_event_id,
        };
        this.$scope.$broadcast('sidenav-open-create_sale', data);
    }

    toggleEvent(event) {
        this.sub_event_id = event.id;
        this.activeEvent = event;
    }

    getEvent() {
        let {id} = this.$state.params;

        if (id) {
            this.EventsResourceService.getEventById(id)
                .then(response => {
                    this.event = response.data.data;

                    if (this.event.subevents[0]) {
                        this.activeEvent = this.event.subevents[0];
                    } else {
                        this.activeEvent = this.event;
                    }
                    this._opts.dataLoad = true;
                });
        }
    }

    goBack(){
        this.$window.history.back()
    }

}

EventsDetailController.$inject = ['$scope', '$state', '$window', 'EventsResourceService'];

export {EventsDetailController};
