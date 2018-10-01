import {SALE_INDEX} from "../Constants";
import {SALE_ACTIVE} from "../Constants";
import {SALE_CLOSED} from "../Constants";


class SaleController {
    constructor($window, $http, $stateParams) {
        this.$window = $window;
        this.$http = $http;
        this.sales = null;
        this._opts = {dataLoad: false};
        this.filter = null;
        this.menu = [
            {status: SALE_ACTIVE, name: 'active'},
            {status: SALE_CLOSED, name: 'closed'},
        ];
        this.$stateParams = $stateParams;

        this.showList();
    }


    showList() {
        self = this;
        this.menu.forEach(function (value, key) {
           if (value.name == self.$stateParams.filter) self.filter = value.status;
        });


        this.$http.get(SALE_INDEX, {params: {filter: this.filter}})
            .then(response => {
                this.sales = response.data.data;
                this._opts.dataLoad = true;
            });
    }


};

SaleController.$inject = ['$window', '$http', '$stateParams'];

export {SaleController};
