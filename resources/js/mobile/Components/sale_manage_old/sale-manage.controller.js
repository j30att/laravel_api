import {BIDS_MY_STORE} from "../../Constants";

class SaleManage {
    constructor($window, $http, $state, $timeout, $scope) {
        this.$http = $http;
        this.$state = $state;
        this.$timeout = $timeout;
        this.$scope = $scope;
        $state.modalOpened = false;
        this.user = window.__user;

        this._opts = {
            stateCreate: false
        };

        this.bid = {
            status: 2,
            markup: '',
            share: '',
            amount:''
        };
    }


    $onInit() {
    }

    setState(action = null){
        console.log(this.sale, 'this.sale');
        this._opts.stateCreate = !this._opts.stateCreate;
        if(action == 'store') this.storeMyBid();
    }
    close(){
        this.show = !this.show;
        this.$state.modalOpened = !this.$state.modalOpened
    }

    /*storeMyBid(){
        this.bid.sale_id = this.sale.id;
        this.bid.user_id = this.user.id;

        this.$http.post(BIDS_MY_STORE, this.bid).then(response =>{
            console.log(response, 'response');
            if (response.data.status == 1) this.sale.bids.push(response.data.bid);

            this.$timeout(() => {
                this.$scope.$apply();
            }, 10);
            console.log(this.sale);
        });

    }*/

}

SaleManage.$inject = ['$window', '$http', '$state', '$timeout', '$scope'];

export const SaleManageComponent = {
    bindings: {
        sale: '<',
        show: '=',
    },
    template: require('./sale-manage.template.html'),
    controller: SaleManage,
    controllerAs: '$ctrl'
};
