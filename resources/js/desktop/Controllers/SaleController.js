import {SALE_INDEX} from "../Constants";
import {SALE_ACTIVE} from "../Constants";
import {SALE_CLOSED} from "../Constants";


class SaleController {
    constructor($window, $http, $stateParams, $mdDialog) {
        this.$mdDialog = $mdDialog;

        this.$window = $window;
        this.$http = $http;
        this.sales = null;
        this._opts = {dataLoad: false};
        this.filter = null;
        this.menu = [
            {status: SALE_ACTIVE, name: 'active'},
            {status: SALE_CLOSED, name: 'closed'},
        ];
        this.$stateParams = $stateParams;
        console.log(this.$mdDialog);
    }


    showAdvanced(ev) {
        console.log(1);
        this.$mdDialog.show({
            //controller: DialogController,
            template: require('../views/sale/create.template.html'),
            parent: angular.element(document.body),
            targetEvent: ev,
            clickOutsideToClose:true,

        })
            .then(function(answer) {

            }, function() {

            });
    };



};

SaleController.$inject = ['$window', '$http', '$stateParams', '$mdDialog'];

export {SaleController};
