import {SALE_ACTIVE, SALE_CLOSED} from "../../../common/Constants";
import {DialogController} from "../DialogController";



class SaleFilterController {
    constructor(SalesResourceService, $stateParams, $mdDialog) {
        this.SalesResourceService = SalesResourceService;
        this.$stateParams = $stateParams;
        this.$mdDialog = $mdDialog;
        this.user = window.__user;
        this.menu = [
            {status: SALE_ACTIVE, name: 'active'},
            {status: SALE_CLOSED, name: 'closed'},
        ];
        this._opts = {dataLoad: false, limit:3};
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

    showCreateForm(ev) {
        let vm = this;
        this.$mdDialog.show({
            controller: DialogController,
            controllerAs: 'vm',
            template: require('../../views/sale/create.template.html'),
            parent: angular.element(document.body),
            targetEvent: ev,

            clickOutsideToClose: true,

        }).openFrom('#left')
            .then(function (answer) {

            }, function () {

            });
    };

};

SaleFilterController.$inject = ['SalesResourceService', '$stateParams', '$mdDialog'];

export {SaleFilterController};
