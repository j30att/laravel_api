import {BIDS_TYPES} from "../../Constants";

class BidsController {
    constructor($window, $http, $state, $scope, BidsResourceService) {
        this.$window = $window;
        this.$http = $http;
        this.$scope = $scope;
        this.filter = null;
        this.$state = $state;
        this.showStub = false;
        this.user = window.__user;
        this.BidsResourceService = BidsResourceService;
        this.bids = [];
        this.bidsTypes = BIDS_TYPES;
        this.bidsActive = this.$state.params.type;
    }

    $onInit(){
        this.getBids();
    }

    togglePlaceBid(){
        console.log('open place bid');
        this.$scope.$broadcast('sidenav-open', () => {
        });
    }

    getBids(){
        if (this.bidsActive == undefined){
        this.BidsResourceService.getMyBids(this.user.id).then((response) => {
           this.bids =  response.data.data;

           if(this.bids.matched.length === 0
               && this.bids.unmatched.length === 0
               && this.bids.settled.length === 0
               && this.bids.canceled.length === 0){
               this.showStub = true;
           }

        });
        }
        if (this.bidsActive == 'matched'){
            this.BidsResourceService.getMyBidsMatched(this.user.id).then((response) => {
                this.bids = response.data.data;
            });

        }
        if (this.bidsActive == 'unmatched'){
            this.BidsResourceService.getMyBidsUnatched(this.user.id).then((response) => {
                this.bids = response.data.data;
            });
        }
        if (this.bidsActive == 'settled'){
            this.BidsResourceService.getMyBidsSettled(this.user.id).then((response) => {
                this.bids = response.data.data;
            });
        }
        if (this.bidsActive == 'canceled'){
            this.BidsResourceService.getMyBidsCanceled(this.user.id).then((response) => {
                this.bids = response.data.data;
            });
        }
    }
}





BidsController.$inject = ['$window', '$http', '$state', '$scope', 'BidsResourceService'];

export {BidsController}
