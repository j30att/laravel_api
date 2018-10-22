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
        console.log(123123123);
    }

    toggleSidenav(index) {
        console.log(1212);
        this.$scope.$broadcast('sidenav-open', () =>{
            console.log('open sidenav')
        });
    }


};

SaleController.$inject = ['SalesResourceService' , '$scope'];

export {SaleController};



