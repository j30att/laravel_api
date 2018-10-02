import {BID_CANCELED, BID_MATCHED, BID_SETTLED, BID_UNMATCHED} from "../Constants"

import {BIDS_INDEX} from "../Constants"

class BidsController {
    constructor($window, $http, $stateParams) {
        this.$window = $window;
        this.$http = $http;
        this.$stateParams = $stateParams;
        this.user = window.__user;
        this.filter = null;

        this.params = {};
        this.bids = [];
        this._opts = {dataLoad: false};
        this.menu = [
            {status: BID_MATCHED, name: 'matched'},
            {status: BID_UNMATCHED, name: 'unmatched'},
            {status: BID_SETTLED, name: 'settled'},
            {status: BID_CANCELED, name: 'canceled'}
        ];
        this.showList();
    }


    showList() {

        self = this;
        this.menu.forEach(function (value, key) {
            if (value.name == self.$stateParams.filter) self.filter = value.status;
        });


        if (this.filter != null) {
            this.params.status = this.filter;
        }

        if (this.user != null) {
            this.params.user_id = this.user.id
        }

        console.log(this.params);


        this.$http.get(BIDS_INDEX, {params: this.params})
            .then(response => {
                this.bids = response.data.data;
                this._opts.dataLoad = true;
            });
    }


};

BidsController.$inject = ['$window', '$http', '$stateParams'];

export {BidsController};
