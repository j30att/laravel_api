import {BID_EVENTS_INDEX} from "../Constants"


class EventsController {
    constructor($window, $http){
        this.$window = $window;
        this.$http = $http;
        this.events =[];
        this._opts = {dataLoad: false};
        this.showList();
    }

    showList() {
        this.$http.get(BID_EVENTS_INDEX,
        ).then(response => {

            this.events = response.data.data;
            this._opts.dataLoad = true;
            console.log(this.events, 'console.log(this.events)');
        });
    }


};

EventsController.$inject = ['$window', '$http'];

export {EventsController};
