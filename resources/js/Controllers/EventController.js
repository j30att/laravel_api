import {EVENTS_INDEX} from "../Constants";

class EventController {
    constructor($window, $http){
        this.$window = $window;
        this.$http = $http;
        this.opened = [] ;
        this._opts = {dataLoad: false};
        this.showList();
        console.log('event controller')
    }

    showList() {
        /*this.$http.get(EVENTS_INDEX,
        ).then(response => {

            this.events = response.data.data;
            this._opts.dataLoad = true;
            console.log(this.events, 'console.log(this.events)');
        });*/
    }

};

EventController.$inject = ['$window', '$http'];

export {EventController};
