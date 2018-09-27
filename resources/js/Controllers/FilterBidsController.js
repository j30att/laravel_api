import {BIDS_MATCHED} from "../Constants"
import {BIDS_UNMATCHED} from "../Constants"
import {BIDS_SETTLED} from "../Constants"
import {BIDS_CANCELED} from "../Constants"


import {BIDS_INDEX} from "../Constants"


class FilterBidsController {
    constructor($window, $http) {
        this.$window = $window;
        this.$http = $http;
        this.filter = BIDS_MATCHED;
        this.bids = [];
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

FilterBidsController.$inject = ['$window', '$http'];

export {FilterBidsController};
