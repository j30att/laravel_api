import {EVENTS_INDEX, SALE_SUBEVENT} from "../Constants";

class EventInfoController {
    constructor($window, $http, $stateParams){
        this.$window = $window;
        this.$http = $http;
        this.$stateParams = $stateParams;
        this._opts = {dataLoad: false};
        this.showList();
    }


    showList() {
        this.$http.get(EVENTS_INDEX+'/'+this.$stateParams.id,
        ).then(response => {
            this.event = response.data.data;

        });

    }

};

EventInfoController.$inject = ['$window', '$http', '$stateParams'];

export {EventInfoController};
