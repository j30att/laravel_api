import {BID_MATCHED, BID_NEW, BID_UNMATCHED} from "../../../common/Constants";

class BidPlace {
    constructor($scope, BidsResourceService, $mdSidenav, $http, SalesService, $timeout, $state) {
        this.BidsResourceService = BidsResourceService;
        this.SalesService = SalesService;
        this.$mdSidenav = $mdSidenav;
        this.$timeout = $timeout;
        this.$state = $state;
        this.$scope = $scope;
        this.$http = $http;
        this.user = window.__user;
        this._opts = {fixed: false};
        this.isSidenavOpen = false;
        this.bid = {};
        this.status = 1;
    }

    $onInit() {
        this.$scope.$on('sidenav-open', (event, data) => {
            this.buildToggler('right');
        });
        this.$scope.$watch('isSidenavOpen', (fixed) => {
            this.$state.modalOpened = fixed
        });

    }

    buildToggler(componentId) {
        this.$mdSidenav(componentId).toggle();
    }

    saveMyBid() {
        this.bid.user_id = this.user.id;
        this.bid.sale_id = this.sale.id;
        this.bid.status = BID_NEW;

        if (this.bid.id == undefined) {
            this.BidsResourceService.storeMyBid(this.bid).then(response => {
                this.sale.bids = response.data.bids;
                this.status = response.data.sale.status;
                this.$scope.$emit('place-a-bid', response.data.sale);
            })
        } else {
            this.BidsResourceService.changeMyBid(this.bid).then((response) => {
                this.sale.bids = response.data.bids;
                this.status = response.data.sale.status;
                this.$scope.$emit('place-a-bid', response.data.sale);
            });
        }
    }

    close(componentId) {
        this.$mdSidenav(componentId).close();
    }

    changeYourBid(bid) {
        this.bid = bid
    }


};

BidPlace.$inject = ['$scope', 'BidsResourceService', '$mdSidenav', '$http', 'SalesService', '$timeout', '$state'];

export const BidPlaceComponent = {
    bindings: {
        sale: '='
    },
    template: require('./bid-place.template.html'),
    controller: BidPlace,
    controllerAs: '$ctrl'
};
