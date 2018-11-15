import {BID_CANCELED, BID_MATCHED, BID_SETTLED, BID_UNMATCHED, SALE_MY} from "../Constants"

import {BIDS_MY} from "../Constants"

class BidsController {
    constructor(BidsResourceService) {
        this.BidsResourceService = BidsResourceService;
        this.user = window.__user;
        this.menu = [
            {status: BID_MATCHED, name: 'matched'},
            {status: BID_UNMATCHED, name: 'unmatched'},
            {status: BID_SETTLED, name: 'settled'},
            {status: BID_CANCELED, name: 'canceled'}
        ];

        this.BidsResourceService.getMyBids(this.user.id)
            .then(response =>{
                this.bids = response.data.data;
            });


    }

};

BidsController.$inject = ['BidsResourceService'];

export {BidsController};
