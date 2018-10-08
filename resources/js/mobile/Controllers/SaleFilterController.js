import {SALE_MY_ACTIVE} from "../Constants";
import {SALE_MY_CLOSED} from "../Constants";
import {SALE_ACTIVE} from "../Constants";
import {SALE_CLOSED} from "../Constants";


class SaleFilterController {
    constructor(SalesResourceService, $stateParams) {
        this.SalesResourceService = SalesResourceService;
        this.user = window.__user;
        this.menu = [
            {status: SALE_ACTIVE, name: 'active'},
            {status: SALE_CLOSED, name: 'closed'},
        ];
        this.$stateParams = $stateParams;
        this._opts = {dataLoad: false};
        this.getList();
    }


    getList() {
        if(this.$stateParams.filter === 'active'){
            this.SalesResourceService.getMySalesActive(this.user.id).then(response => {
                this.sales = response.data.data;
            })
        }
        if(this.$stateParams.filter === 'closed'){
            this.SalesResourceService.getMySalesClosed(this.user.id).then(response => {
                this.sales = response.data.data;
            })
        }
    }


};

SaleFilterController.$inject = ['SalesResourceService', '$stateParams'];

export {SaleFilterController};
