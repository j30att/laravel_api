import {BIDS_TYPES} from "../../Constants";

class BidsController {
    constructor($window, $http, $state, $scope, BidsResourceService) {
        this.$window = $window;
        this.$http = $http;
        this.$scope = $scope;
        this.filter = null;
        this.$state = $state;
        this.showStub = false;
        this.ready = false;
        this.user = window.__user;
        this.BidsResourceService = BidsResourceService;
        this.bids = [];
        this.bidsTypes = BIDS_TYPES;
        this.bidsActive = this.$state.params.type;
    }

    $onInit() {
        this.getBids();
    }

    togglePlaceBid(bid) {
        console.log(bid, 'bid');
        this.sale = bid.sale;

        this.$scope.$broadcast('sidenav-open', () => {
        });
    }

    getBids() {
        switch (this.bidsActive) {
            case ('matched'):
                this.BidsResourceService.getMyBidsMatched(this.user.id)
                    .then((response) => {
                        this.bids = response.data.data;
                        this.ready = true;
                    });
                break;
            case ('unmatched'):
                this.BidsResourceService.getMyBidsUnatched(this.user.id)
                    .then((response) => {
                        this.bids = response.data.data;
                        this.ready = true;
                    });
                break;
            case ('settled'):
                this.BidsResourceService.getMyBidsSettled(this.user.id)
                    .then((response) => {
                        this.bids = response.data.data;
                        this.ready = true;
                    });
                break;
            case ('canceled'):
                this.BidsResourceService.getMyBidsCanceled(this.user.id)
                    .then((response) => {
                        this.bids = response.data.data;
                        this.ready = true;
                    });
                break;
            default:
                this.BidsResourceService.getMyBids(this.user.id)
                    .then((response) => {
                        this.bids = response.data.data;

                        if (this.emptyBids(this.bids)) {
                            this.showStub = true;
                        }

                        this.ready = true;
                    });
        }
    }

    emptyBids(bids) {
        return this.bids.matched.length === 0
            && this.bids.unmatched.length === 0
            && this.bids.settled.length === 0
            && this.bids.canceled.length === 0
    }
}


BidsController.$inject = ['$window', '$http', '$state', '$scope', 'BidsResourceService'];

export {BidsController}
