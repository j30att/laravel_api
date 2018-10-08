import {BID_CANCELED, BID_MATCHED, BID_SETTLED, BID_UNMATCHED, SALE_MY} from "../Constants"

import {BIDS_MY} from "../Constants"

class BidsController {
    constructor($http) {
        this.$http = $http;
        this.user = window.__user;
        this.bids = [];
        this._opts = {dataLoad: false};
        this.menu = [
            {status: BID_MATCHED, name: 'matched'},
            {status: BID_UNMATCHED, name: 'unmatched'},
            {status: BID_SETTLED, name: 'settled'},
            {status: BID_CANCELED, name: 'canceled'}
        ];
        this.getList({user_id: this.user.id});
    }

    getList() {
        this.$http.post(BIDS_MY, {user_id: this.user.id})
            .then(response => {
                this.bids = response.data.data;
                this._opts.dataLoad = true;
            });
    }


};

BidsController.$inject = ['$http'];

export {BidsController};
