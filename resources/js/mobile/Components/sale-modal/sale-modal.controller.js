import {BIDS_MY_STORE} from "../../Constants";

class SaleModal {
    constructor($window, $http) {
        this.$http = $http;
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
        if(action == 'store') this.storeMyBid();
        this._opts.stateCreate = !this._opts.stateCreate;
    }
    close(){
        this.show = !this.show;
    }

    storeMyBid(){
        this.bid.sale_id = this.sale.id;
        this.bid.user_id = this.user.id;
        console.log(this.bid, this.bid);
        this.$http.post(BIDS_MY_STORE, this.bid).then(response =>{

        });

    }
}

SaleModal.$inject = ['$window', '$http'];

export const SaleModalComponent = {
    bindings: {
        sale: '<',
        show: '=',
    },
    template: require('./sale-modal.template.html'),
    controller: SaleModal,
    controllerAs: '$ctrl'
};
