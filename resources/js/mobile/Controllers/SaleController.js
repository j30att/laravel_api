import {SALE_INDEX} from "../Constants";
import {SALE_ACTIVE} from "../Constants";
import {SALE_CLOSED} from "../Constants";


class SaleController {
    constructor($window, $http, $stateParams) {
        this.$window = $window;
        this.$http = $http;
        this.user = window.__user;
        this.sales = null;
        this._opts = {dataLoad: false};
        this.filter = null;
        this.params = {page: 'sales'};
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




        if (this.filter != null){
            this.params.status = this.filter;
        }
        if (this.user != null){
            this.params.user_id = this.user.id
        }

        this.$http.get(SALE_INDEX, {params:this.params})
            .then(response => {
                this.sales = response.data.data;
                this._opts.dataLoad = true;
            });
    }


};

SaleController.$inject = ['$window', '$http', '$stateParams'];

export {SaleController};
