import {SALE_MY} from "../Constants";

class SaleController {
    constructor(SalesResourceService, $scope) {
        this.SalesResourceService = SalesResourceService;
        this.user = window.__user;
        this._opts = {dataLoad: false};
        this.$scope = $scope;
        this.SalesResourceService.getMySales(this.user.id).then(response =>{
            this.sales = response.data.data;
        });
    }

    toggleSidenav(index) {
        this.$scope.$broadcast('sidenav-open', () =>{
            console.log('open sidenav')
        });
    }
};

SaleController.$inject = ['SalesResourceService' , '$scope'];

export {SaleController};



