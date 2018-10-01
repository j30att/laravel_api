import {EVENTS_INDEX} from "../Constants"


class InvestController {
    constructor($window, $http){
        this.$window = $window;
        this.$http = $http;
        this.events =[];
        this._opts = {dataLoad: false};
        this.showList();
        this.getSales();

    }

    showList() {
        this.$http.get(EVENTS_INDEX,
        ).then(response => {
            this.events = response.data.data;
            this._opts.dataLoad = true;
            console.log(this.events, 'console.log(this.events)');
        });
    }

    getSales(){

    }


};

InvestController.$inject = ['$window', '$http'];

export {InvestController};
