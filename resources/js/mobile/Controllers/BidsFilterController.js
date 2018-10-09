import {BID_CANCELED, BID_MATCHED, BID_SETTLED, BID_UNMATCHED, SALE_MY} from "../Constants"
import {BIDS_MY_CANCELED, BIDS_MY_SETTLED, BIDS_MY_UNMATCHED, BIDS_MY_MATCHED} from "../Constants";


class BidsFilterController {
    constructor($stateParams, BidsResourceService) {
        this.BidsResourceService = BidsResourceService;
        this.$stateParams = $stateParams;
        this.user = window.__user;
        this.menu = [
            {status: BID_MATCHED, name: 'matched'},
            {status: BID_UNMATCHED, name: 'unmatched'},
            {status: BID_SETTLED, name: 'settled'},
            {status: BID_CANCELED, name: 'canceled'}
        ];
        this._opts = {dataLoad: false};
        this.getList();

    }


    getList() {
        if (this.$stateParams.filter === 'matched') {
            this.BidsResourceService.getMyBidsMatched(this.user.id)
                .then(response =>{
                    this.bids = response.data.data;
                });
        }
        if (this.$stateParams.filter === 'unmatched') {
            this.BidsResourceService.getMyBidsUnatched(this.user.id)
                .then(response =>{
                    this.bids = response.data.data;
                });
        }
        if (this.$stateParams.filter === 'settled') {
            this.BidsResourceService.getMyBidsSettled(this.user.id)
                .then(response =>{
                    this.bids = response.data.data;
                });
        }
        if (this.$stateParams.filter === 'canceled') {
            this.BidsResourceService.getMyBidsCanceled(this.user.id)
                .then(response =>{
                    this.bids = response.data.data;
                });
        }

    }



};

BidsFilterController.$inject = ['$stateParams', 'BidsResourceService'];

export {BidsFilterController};
