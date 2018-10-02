import {EVENTS_INDEX, SALE_INDEX} from "../Constants";

class EventController {
    constructor($window, $http, $stateParams){
        this.$window = $window;
        this.$http = $http;
        this.$stateParams = $stateParams;
        this._opts = {dataLoad: false};
        this.showList();
        console.log('event controller')
    }



    showList() {
        this.$http.get(EVENTS_INDEX+'/'+this.$stateParams.id,
        ).then(response => {
            this.event = response.data.data;
            this.opened = (this.event.subevents[0].id);
            this._opts.dataLoad = true;
        });
    }

    getSale(id){
        this.$http.get(SALE_INDEX, {params: {sub_event_id: id}})
        .then(response => {
            this.sales = response.data.data;
            this.opened = (this.event.subevents[0].id);

            this._opts.dataLoad = true;
        });
    }

    clickTab(id){
        this.opened = id;
    }

    showTab(id){
        if (this.opened === id) return true
        return false;
    }

};

EventController.$inject = ['$window', '$http', '$stateParams'];

export {EventController};
