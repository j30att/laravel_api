import {SALE_LOWEST, SALE_CLOSING} from "../Constants"


class SaleAllController {
    constructor($window, $http){
        this.$window = $window;
        this.$http = $http;
        this.events =[];
        this._opts = {dataLoad: false};
        this.filter = 'closing';
        this.setFilter(this.filter);

    }

    setFilter(param){
        if (param == 'closing') {this.filter = 'closing'; this.getSales(SALE_CLOSING)}
        if (param == 'markup') {this.filter = 'markup'; this.getSales(SALE_LOWEST)}
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

SaleAllController.$inject = ['$window', '$http'];

export {SaleAllController};
