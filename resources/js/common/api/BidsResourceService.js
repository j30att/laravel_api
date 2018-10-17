import {
    BIDS_MY_MATCHED, BIDS_MY_UNMATCHED, BIDS_MY_SETTLED, BIDS_MY_CANCELED, BIDS_MY_STORE, BIDS_MY,
    BID_MATCHED, BID_UNMATCHED, BID_SETTLED, BID_CANCELED
} from "../Constants";

class BidsResourceService {
    constructor($http) {
        this.$http = $http;
    }

    getMyBids(user_id) {
        return this.$http.post(BIDS_MY, {user_id: user_id});
    }

    getMyBidsMatched(user_id) {
        return this.$http.post(BIDS_MY_MATCHED, {status: BID_MATCHED, user_id: user_id});
    };

    getMyBidsUnatched(user_id) {
        return this.$http.post(BIDS_MY_UNMATCHED, {status: BID_UNMATCHED, user_id: user_id});
    };

    getMyBidsSettled(user_id) {
        return this.$http.post(BIDS_MY_SETTLED, {status: BID_SETTLED, user_id: user_id});
    };

    getMyBidsCanceled(user_id) {
        return this.$http.post(BIDS_MY_CANCELED, {status: BID_CANCELED, user_id: user_id});
    };

    storeMyBid(bid){
        return this.$http.post(BIDS_MY_STORE, {bid});

    }
}

BidsResourceService.$inject = ['$http'];

export {BidsResourceService};