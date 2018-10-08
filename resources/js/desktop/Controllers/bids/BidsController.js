import {BIDS_TYPES} from "./constants";

class BidsController {
    constructor($window, $http, $state) {
        this.$window = $window;
        this.$http = $http;
        this.filter = null;
        this.$state = $state;

        this.bids = [];
        this.bidsTypes = BIDS_TYPES;
        this.bidsActive = this.$state.params.type;
    }

    $onInit(){
        let allBids = require('../../../common/api/bids-lists.json');
        this.bids = allBids.data[this.bidsActive];
        console.log(this.bids);
    }
}

BidsController.$inject = ['$window', '$http', '$state'];

export {BidsController}
