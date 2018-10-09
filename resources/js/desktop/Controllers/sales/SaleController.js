import {DialogController} from "../DialogController";

class SaleController {
    constructor(SalesResourceService, $mdDialog) {
        this.SalesResourceService = SalesResourceService;
        this.$mdDialog = $mdDialog;
        this.user = window.__user;
        this._opts = {dataLoad: false, limit:3};

        this.SalesResourceService.getMySales(this.user.id, this._opts.limit).then(response =>{
            this.sales = response.data.data;
            console.log(this.sales);
        });
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

        }).then(function (answer) {

            }, function () {

            });
    };


};

SaleController.$inject = ['SalesResourceService', '$mdDialog'];

export {SaleController};



