import {BID_RESPONSE_MATCHED} from "../Constants"
import {BID_RESPONSE_UNMATCHED} from "../Constants"
import {BID_RESPONSE_SETTLED} from "../Constants"
import {BID_RESPONSE_CANCELED} from "../Constants"


import {BID_RESPONSE_INDEX} from "../Constants"


class FilterBidResponsesController {
    constructor($window, $http) {
        this.$window = $window;
        this.$http = $http;
        this.filter = BID_RESPONSE_MATCHED;
        this.bids = [];
        this.showListFiltred();
        this.menu = [
            {status: BID_RESPONSE_MATCHED, name: 'Matched'},
            {status: BID_RESPONSE_UNMATCHED, name: 'Unmatched'},
            {status: BID_RESPONSE_SETTLED, name: 'Settled'},
            {status: BID_RESPONSE_CANCELED, name: 'Canceled'}
        ]

    }

    setFilter(status){
        this.filter = status;
        this.showListFiltred();
    }





    showListFiltred() {
        this.$http.get(BID_RESPONSE_INDEX, {
            params: {filter: this.filter}
        }).then(response => {

            this.bids = response.data.data;

        });
    }


};

FilterBidResponsesController.$inject = ['$window', '$http'];

export {FilterBidResponsesController};
