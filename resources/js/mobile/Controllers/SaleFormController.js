import {EVENTS_INDEX, SALE_INDEX, SUBEVENTS_INDEX} from "../Constants"
import {SALE_CREATE} from "../Constants"

class SaleFormController {
    constructor($window, $http, $stateParams){
        this.$window = $window;
        this.$http = $http;
        this.$stateParams = $stateParams;
        this.event = null;
        this.subevents = null;
        this.subevent = null;
        this.buy_in =null;

        this._opts ={
            load: false,
            update: false
        };

        if(this.$stateParams.hasOwnProperty('id')) {
            this._opts.update = true;
            this.getSale();
        } else {

            this.sale = {
                event_id: null,
                user_id: window.__user.id,
                flight_id:1,
                status:1,
                sub_event_id:null,
                markup: null,
                share:null,
                amount:null
            };
        }
        this.getEvents();
    }

    getEvents() {
        this.$http.get(EVENTS_INDEX)
            .then(response => {
                this.events = response.data.data;
                this._opts.load = true;
            });
    }
    getSubevents(){
        this.$http.get(SUBEVENTS_INDEX, {params: {event_id: this.sale.event_id}})
                .then(response => {
                    this.buy_in = null;
                    this.subevents = response.data.data;
                    this._opts.load = true;
                    this.fillSale()
                });

    }
    fillSale(){
                let self = this;
        angular.forEach(this.subevents, function (value, key) {
            if (value.id == self.sale.sub_event_id){
                self.buy_in = value.buy_in;
            }
        })
    }



    getSale(){
        this.$http.get(SALE_INDEX+'/'+this.$stateParams.id)
            .then(response => {
                this.sale = response.data.data;
                if(this._opts.update) this.getSubevents()

            });
    }


    createSale(){
        let data = this.sale;
        this.$http.post(SALE_CREATE, data)
            .then(response => {
                if (response.status === 200) window.location.href = '/sales';
                console.log(response);
            });
        console.log(this.sale, 'sale');
    }

    updateSale(){
        let data = this.sale;
        console.log(SALE_CREATE+'/'+this.sale.id);
        this.$http.put(SALE_CREATE+'/'+this.sale.id, data)
            .then(response => {
                console.log(response);
                if (response.status == 200) window.location.href = '/sale';
                console.log(response);
            });
        console.log(this.sale, 'sale');
    }


};

SaleFormController.$inject = ['$window', '$http', '$stateParams'];

export {SaleFormController};
