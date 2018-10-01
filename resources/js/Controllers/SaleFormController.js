import {EVENTS_INDEX} from "../Constants"
import {SALE_CREATE} from "../Constants"

class SaleFormController {
    constructor($window, $http, $stateParams){
        this.$window = $window;
        this.$http = $http;
        this.$stateParams = $stateParams;
        this.event = null;
        this.subevent = null;
        this.sale = {
            user_id: window.__user.id,
            flight_id:1,
            status:1,
            sub_event_id:null,
            buy_in: null,
            markup: null,
            share:null,
            amount:null
        };
        this._opts ={
          load: false
        };
        this.getEvents();

    }

    getEvents() {
        this.$http.get(EVENTS_INDEX)
            .then(response => {
            this.events = response.data.data;
            this._opts.load = true;

        });
    }

    fillSale(){
        this.sale.buy_in = this.subevent.buy_in;
        this.sale.sub_event_id = this.subevent.id;
    }

    createSale(){
        let data = this.sale;
        this.$http.post(SALE_CREATE, data)
            .then(response => {
                if (response.status == 1) window.location.href = '/sale';
                console.log(response);
            });
        console.log(this.sale, 'sale');
    }


};

SaleFormController.$inject = ['$window', '$http', '$stateParams'];

export {SaleFormController};
