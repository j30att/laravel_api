import {EVENTS_INDEX, SALE_CLOSED, SALE_INDEX, SALE_MARKUP} from "../../Constants"
import {DialogController} from "../DialogController";


class InvestController {
    constructor($window, $http, $mdDialog){
        this.$window = $window;
        this.$mdDialog = $mdDialog;
        this.$http = $http;
        this.events =[];
        this._opts = {dataLoad: false};
        this.filter=SALE_CLOSED;
        this.showList();
        this.getSales();
    }

    setFilter(param){
        if (param == 'closed') {this.filter=SALE_CLOSED; this.getSales()}
        if (param == 'markup') {this.filter=SALE_MARKUP; this.getSales()}
    }

    showList() {
        this.$http.get(EVENTS_INDEX,
        ).then(response => {
            this.events = response.data.data;
            this._opts.dataLoad = true;
            console.log(this.events, 'console.log(this.events)');
        });
    }


    showCreateForm(ev) {
        let vm = this;
        this.$mdDialog.show({
            controller: DialogController,
            controllerAs: 'vm',
            template: require('../../views/bids/place.template.html'),
            parent: angular.element(document.body),
            targetEvent: ev,

            clickOutsideToClose: true,

        }).openFrom('#left')
            .then(function (answer) {

            }, function () {

            });
    };


    getSales(){
        this.$http.get(SALE_INDEX, {params: {status: this.filter}})
        .then(response => {
            this.sales = response.data.data;
            this._opts.dataLoad = true;
            return true;
        });
    }


};

InvestController.$inject = ['$window', '$http', '$mdDialog'];

export {InvestController};
