import {SALE_CLOSED} from "../../../common/Constants"
class SaleController {
    constructor(SalesResourceService, $scope) {
        this.SalesResourceService = SalesResourceService;
        this.$scope = $scope;
        this.user = window.__user;
        this._opts = {dataLoad: false, limit:3, openedForm:false};
        this.SalesResourceService.getMySales(this.user.id, this._opts.limit).then(response =>{
            this.sales = response.data.data;
        });
    }

    toggleSidenav(index) {
        this.$scope.$broadcast('sidenav-open', () =>{
            console.log('open sidenav')
        });
    }

    toggleSidenavManage(item) {
        if(item.status === SALE_CLOSED) return false;
        this.$scope.$broadcast('sidenavManage-open', item);
    }

}

SaleController.$inject = ['SalesResourceService', '$scope'];

export {SaleController};



