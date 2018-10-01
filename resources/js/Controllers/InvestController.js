import {EVENTS_INDEX, SALE_CLOSED, SALE_INDEX, SALE_MARKUP} from "../Constants"


class InvestController {
    constructor($window, $http){
        this.$window = $window;
        this.$http = $http;
        this.events =[];
        this._opts = {dataLoad: false};
        this.filter=SALE_CLOSED;
        this.showList();
        this.getSales();
    }

    setFilter(param){
        if (param == 'closed') {this.filter=SALE_CLOSED; this.getSales()}
        if (param == 'markup') {this.filter=SALE_MARKUP; this.getSales()}
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
        this.$http.get(SALE_INDEX, {params: {status: this.filter}})
        .then(response => {
            this.sales = response.data.data;
            this._opts.dataLoad = true;
            return true;
        });

    }


};

InvestController.$inject = ['$window', '$http'];

export {InvestController};
