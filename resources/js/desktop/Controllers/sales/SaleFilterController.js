import {SALE_ACTIVE, SALE_CLOSED} from "../../../common/Constants";

class SaleFilterController {
    constructor(SalesResourceService, $stateParams, $scope, $state) {
        this.$state = $state;
        this.SalesResourceService = SalesResourceService;
        this.$stateParams = $stateParams;
        this.$scope = $scope;
        this.user = window.__user;
        this.menu = [
            {status: SALE_ACTIVE, name: 'active'},
            {status: SALE_CLOSED, name: 'closed'},
        ];
        this._opts = {dataLoad: false, limit:3, openedForm:false};
        this.getList();
    }


    getList() {
        if(this.$stateParams.type === 'active'){
            this.SalesResourceService.getMySalesActive(this.user.id, this._opts.limit).then(response => {
                this.sales = response.data.data;
                this._opts.dataLoad = true;
            })
        }
        if(this.$stateParams.type === 'closed'){
            this.SalesResourceService.getMySalesClosed(this.user.id, this._opts.limit).then(response => {
                this.sales = response.data.data;
                this._opts.dataLoad = true;
            })
        }
    }

    toggleSidenav() {
        this.$scope.$broadcast('sidenav-open', () =>{
            console.log('open sidenav')
        });
    }

};

SaleFilterController.$inject = ['SalesResourceService', '$stateParams', '$scope', '$state'];

export {SaleFilterController};
