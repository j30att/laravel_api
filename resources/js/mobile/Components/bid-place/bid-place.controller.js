import {BID_MATCHED, BID_NEW, BID_UNMATCHED} from "../../../common/Constants";



class BidPlace {
    constructor($scope, BidsResourceService, $mdSidenav, $http, SalesService, $timeout, $state, BidsService) {
        this.BidsResourceService = BidsResourceService;
        this.SalesService = SalesService;
        this.$mdSidenav = $mdSidenav;
        this.$timeout = $timeout;
        this.$state = $state;
        this.BidsService = BidsService;
        this.$scope = $scope;
        this.$http = $http;
        this.user = window.__user;
        this._opts = {stateCreate: false};
        this.isSidenavOpen =false;
    }

    $onInit(){
        this.$scope.$on('sidenavPlace-open', (event, data) => {
            this.buildToggler('right');
        });
        this.$scope.$watch('isSidenavOpen', (fixed) => {
            this.$state.modalOpened = fixed
        });

    }

    buildToggler(componentId) {
        this.$mdSidenav(componentId).toggle();
    }

    saveMyBid(){
        this.bid.user_id = this.user.id;
        this.bid.sale_id = this.sale.id;
        this.bid.status  = BID_NEW;
        this.BidsResourceService.storeMyBid(this.bid).then(response => {
            this.sale.bids = response.data.bids;
        })
    }

    close(componentId){
        this.$mdSidenav(componentId).close();
    }
    setState(){
        this._opts.stateCreate = !this._opts.stateCreate;
    }

    calcAmount(){
        if (this.bid.amount != null && this.bid.markup != null){
            this.bid.share = this.BidsService.calcShare(this.bid.amount, this.sale.event.buy_in);
        }

        if (this.bid.share !=  null && this.bid.markup != null &&  this.bid.share !=0){
            this.bid.amount = this.BidsService.calcAmount(this.bid.share, this.bid.markup, this.sale.event.buy_in);
        }

        if (this.bid.amount != null && this.bid.share !=  null){

        }

    }

    calcMarkup(){

    }

    calcShare(){

    }



};

BidPlace.$inject = ['$scope', 'BidsResourceService', '$mdSidenav', '$http', 'SalesService', '$timeout', '$state', 'BidsService'];

export const BidPlaceComponent = {
    bindings: {
        sale: '='
    },
    template: require('./bid-place.template.html'),
    controller: BidPlace,
    controllerAs: '$ctrl'
};
