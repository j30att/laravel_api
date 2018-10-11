class SaleInvestController {
    constructor(SalesResourceService, $scope) {
        this.SalesResourceService = SalesResourceService;
        this.$scope = $scope;
        this.user = window.__user;
        this._opts = {dataLoad: false, limit:3, openedForm:false};


        this.SalesResourceService.getMySales(this.user.id, this._opts.limit).then(response =>{
            this.sales = response.data.data;
        });
    }

    toggleSidenav() {
        this.$scope.$broadcast('sidenav-open', () =>{
            console.log('open sidenav')
        });
    }

};

SaleInvestController.$inject = ['SalesResourceService', '$scope'];

export {SaleInvestController};



