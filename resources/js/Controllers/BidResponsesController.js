import {BID_RESPONSE_MATCHED} from "../Constants"
import {BID_RESPONSE_UNMATCHED} from "../Constants"
import {BID_RESPONSE_SETTLED} from "../Constants"
import {BID_RESPONSE_CANCELED} from "../Constants"


import {BID_RESPONSE_INDEX} from "../Constants"


class BidResponsesController {
    constructor($window, $http) {
        this.$window = $window;
        this.$http = $http;
        this.bids = [];
        this.showList();
        this._opts = {dataLoad: false};
        this.menu = [
            {status: BID_RESPONSE_MATCHED,      name: 'Matched'},
            {status: BID_RESPONSE_UNMATCHED,    name: 'Unmatched'},
            {status: BID_RESPONSE_SETTLED,      name: 'Settled'},
            {status: BID_RESPONSE_CANCELED,     name: 'Canceled'}
        ]

    }
    showList() {
        this.$http.get(BID_RESPONSE_INDEX,
        ).then(response => {
            this.bids = response.data;
            this._opts.dataLoad = true;
        });
    }


};

BidResponsesController.$inject = ['$window', '$http'];

export {BidResponsesController};
