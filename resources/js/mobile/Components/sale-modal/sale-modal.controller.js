import {BIDS_MY_STORE} from "../../Constants";

class SaleModal {
    constructor($window, $http, $state) {
        this.$http = $http;
        this.$state = $state;
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
        this._opts.stateCreate = !this._opts.stateCreate;
        if(action == 'store') this.storeMyBid();
    }
    close(){
        this.show = !this.show;
        this.$state.modalOpened = !this.$state.modalOpened
    }

    storeMyBid(){
        this.bid.sale_id = this.sale.id;
        this.bid.user_id = this.user.id;

        this.$http.post(BIDS_MY_STORE, this.bid).then(response =>{
            console.log(response, 'response');
            if (response.data.status == 1) this.sale.bids.push(response.data.bid)
            console.log(this.sale);
        });

    }
}

SaleModal.$inject = ['$window', '$http', '$state'];

export const SaleModalComponent = {
    bindings: {
        sale: '<',
        show: '=',
    },
    template: require('./sale-modal.template.html'),
    controller: SaleModal,
    controllerAs: '$ctrl'
};
