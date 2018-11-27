import {SALE_LOWEST, SALE_CLOSING} from "../Constants"


class SaleAllController {
    constructor($window, $http, $state){
        this.$window = $window;
        this.$http = $http;
        this.events =[];
        this._opts = {dataLoad: false};
        this.filter = 'closing';
        this.setFilter(this.filter);
        this.$state = $state;

        console.log(this.$state.current, 'this.$state.current');
        console.log(this.$state, 'this.$state')

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

SaleAllController.$inject = ['$window', '$http', '$state'];

export {SaleAllController};
