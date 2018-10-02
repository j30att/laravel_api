import {SALE_INDEX} from "../Constants"

class SaleManageController {
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
        this.getSale();
    }

  /*  getEvents() {
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
        console.log(this.subevents, 'this.subevents');
        angular.forEach(this.subevents, function (value, key) {
            if (value.id == self.sale.sub_event_id){
                self.buy_in = value.event.buy_in;
            }
        });

    }
*/


    getSale(){
        this.$http.get(SALE_INDEX+'/'+this.$stateParams.id)
            .then(response => {
                this.sale = response.data.data;
                console.log(this.sale);
            });
    }


  /*  createSale(){
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
*/

};

SaleManageController.$inject = ['$window', '$http', '$stateParams'];

export {SaleManageController};
