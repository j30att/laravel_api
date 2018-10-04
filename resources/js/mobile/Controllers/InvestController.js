import {EVENTS_INDEX, SALE_CLOSED, SALE_INDEX, SALE_MARKUP, SALE_CLOSING, SALE_LOWEST} from "../Constants"


class InvestController {
    constructor($window, $http){
        this.$window = $window;
        this.$http = $http;
        this.events =[];
        this._opts = {dataLoad: false};
        this.filter = 'closing';

        this.showList();
        this.setFilter(this.filter);

    }

    setFilter(param){
        if (param == 'closing') {this.filter = 'closing'; this.getSales(SALE_CLOSING)}
        if (param == 'markup') {this.filter = 'markup'; this.getSales(SALE_LOWEST)}
    }

    showList() {
        this.$http.get(EVENTS_INDEX,
        ).then(response => {
            this.events = response.data.data;
            this._opts.dataLoad = true;
            console.log(this.events, 'console.log(this.events)');
        });
    }


    getSales(url){
        this.$http.post(url)
        .then(response => {
            this.sales = response.data.data;
            this._opts.dataLoad = true;
            return true;
        });

    }




};

InvestController.$inject = ['$window', '$http'];

export {InvestController};
