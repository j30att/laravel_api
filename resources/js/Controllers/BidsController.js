import {
    BID_RESPONSE_CANCELED, BID_RESPONSE_MATCHED, BID_RESPONaSE_SETTLED, BID_RESPONSE_UNMATCHED,

} from "../Constants"
import {BIDS_CANCELED} from "../Constants"

import {BIDS_INDEX} from "../Constants"

class BidsController {
    constructor($window, $http) {
        this.$window = $window;
        this.$http = $http;
        this.filter = null;
        this.bids = [];
        this.menu = [
            {status: BID_MATCHED,      name: 'Matched'},
            {status: BID_UNMATCHED,    name: 'Unmatched'},
            {status: BID_SETTLED,      name: 'Settled'},
            {status: BID_CANCELED,     name: 'Canceled'}
        ];
        this.showListFiltred();
    }


    showListFiltred() {
        this.$http.get(BIDS_INDEX, {
            params: {filter:this.filter}
        }).then(response => {
            console.log(response.data.data);
            this.bids = response.data.data;
        });
    }


};

BidsController.$inject = ['$window', '$http'];

export {BidsController};
