import {SALE_MY} from "../Constants";

class SaleController {
    constructor(SalesResourceService, $scope) {
        this.SalesResourceService = SalesResourceService;
        this.user = window.__user;
        this._opts = {dataLoad: false};
        this.$scope = $scope;
        this.showStub = false;

        this.SalesResourceService.getMySales(this.user.id).then(response =>{
            this.sales = response.data.data;
            this._opts.dataLoad = true;
            console.log(this.sales);
            if (this.sales.active.length == 0 && this.sales.closed.length == 0){
                this.showStub = true;
            }
        });
    }

    toggleSidenav() {
        this.$scope.$broadcast('sidenav-open', () =>{
            console.log('open sidenav')
        });
    }
};

SaleController.$inject = ['SalesResourceService' , '$scope'];

export {SaleController};



