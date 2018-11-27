import {BID_CANCELED, BID_MATCHED, BID_SETTLED, BID_UNMATCHED, SALE_MY} from "../Constants"

import {BIDS_MY} from "../Constants"

class BidsController {
    constructor(BidsResourceService, $scope) {
        this.BidsResourceService = BidsResourceService;
        this.user = window.__user;
        this.$scope = $scope;
        this.menu = [
            {status: BID_MATCHED, name: 'matched'},
            {status: BID_UNMATCHED, name: 'unmatched'},
            {status: BID_SETTLED, name: 'settled'},
            {status: BID_CANCELED, name: 'canceled'}
        ];

        this.BidsResourceService.getMyBids(this.user.id)
            .then(response =>{
                this.bids = response.data.data;
                if(    this.bids.canceled.length == 0
                    && this.bids.matched.length == 0
                    && this.bids.settled.length == 0
                    && this.bids.unmatched.length == 0){
                    this.state = 'empty';
                }
            });


    }

    togglePlace() {
        this.$scope.$broadcast('sidenavPlace-open', () =>{
            console.log('open sidenav');
        });
    }

};

BidsController.$inject = ['BidsResourceService', '$scope'];

export {BidsController};
