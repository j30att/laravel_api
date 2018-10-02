import {EVENTS_INDEX, SALE_CLOSED, SALE_INDEX, SALE_MARKUP} from "../Constants"


class SaleAllController {
    constructor($window, $http){
        this.$window = $window;
        this.$http = $http;
        this.events =[];
        this._opts = {dataLoad: false};
        this.filter=SALE_CLOSED;

        this.getSales();
        console.log('hui');
    }

    setFilter(param){
        if (param == 'closed') {this.filter=SALE_CLOSED; this.getSales()}
        if (param == 'markup') {this.filter=SALE_MARKUP; this.getSales()}
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

SaleAllController.$inject = ['$window', '$http'];

export {SaleAllController};
