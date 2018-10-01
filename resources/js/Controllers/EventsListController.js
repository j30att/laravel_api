import {EVENTS_INDEX} from "../Constants";

class EventsListController {
    constructor($window, $http){
        this.$window = $window;
        this.$http = $http;
        this.opened = [] ;
        this._opts = {dataLoad: false};
        this.showList()
    }

    showList() {
        this.$http.get(EVENTS_INDEX,
        ).then(response => {

            this.events = response.data.data;
            this._opts.dataLoad = true;
            console.log(this.events, 'console.log(this.events)');
        });
    }

};

EventsListController.$inject = ['$window', '$http'];

export {EventsListController};
