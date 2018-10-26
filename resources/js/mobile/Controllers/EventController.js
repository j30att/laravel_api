import {EVENTS_INDEX, SALE_SUBEVENT} from "../Constants";

class EventController {
    constructor($window, $http, $stateParams, $state){
        this.$window = $window;
        this.$http = $http;
        this.$state = $state;
        this.$stateParams = $stateParams;
        this._opts = {dataLoad: false};
        this.showList();
        if (this.$state.subevent_id != undefined){
            this.getSale(this.$state.subevent_id);
        }

    }


    showList() {
        this.$http.get(EVENTS_INDEX+'/'+this.$stateParams.id,
        ).then(response => {
            this.event = response.data.data;
            console.log(this.$state.subevent_id);
            if (this.$state.subevent_id == undefined){
                console.log(111);
                this.getSale(this.event.subevents[0].id);
            }
        });

    }

    getSale(id){
        this.opened = id;
        this.$http.post(SALE_SUBEVENT, {sub_event_id:id})
        .then(response => {
            this.sales = response.data.data;
            this._opts.dataLoad = true;
        });
    }

};

EventController.$inject = ['$window', '$http', '$stateParams', '$state'];

export {EventController};
