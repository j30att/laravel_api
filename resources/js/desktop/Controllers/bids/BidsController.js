import {BIDS_TYPES} from "../../Constants";

class BidsController {
    constructor($window, $http, $state, $scope, BidsResourceService) {
        this.$window = $window;
        this.$http = $http;
        this.$scope = $scope;
        this.filter = null;
        this.$state = $state;
        this.user = window.__user;
        this.BidsResourceService = BidsResourceService;
        this.bids = [];
        this.bidsTypes = BIDS_TYPES;
        this.bidsActive = this.$state.params.type;
        this.getBids();
        console.log(this.bidsActive, 'this.bidsActive');

    }

    $onInit(){
        let allBids = require('../../../common/api/bids-lists.json');
        this.bids = allBids.data[this.bidsActive];
        //console.log(this.bids, 'this bids');
    }

    getBids(){
        if (this.bidsActive == undefined){
        this.BidsResourceService.getMyBids(this.user.id).then((response) => {
           this.bids =  response.data.data;

           if(this.bids.matched.length == 0
               && this.bids.unmatched.length ==0
               && this.bids.settled.length == 0
               && this.bids.canceled.length){
               this.state = 'empty';
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
