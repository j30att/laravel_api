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
            this.stopBodyScrolling(fixed);
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

    changeAmount(){
        if (this.bid.share != null){
            this.bid.markup = this.BidsService.calcMarkup(this.bid.share, this.bid.amount, this.sale.event.buy_in);
        } else {
            this.bid.share = this.BidsService.calcShare(this.bid.markup, this.bid.amount, this.sale.event.buy_in);
        }
    }
    changeShare(){
        if (this.bid.markup = null){
           this.bid.amount = this.BidsService.calcAmount(this.bid.markup, this.bid.share, this.sale.event.buy_in);
       } else {
           this.bid.markup = this.BidsService.calcMarkup(this.bid.share, this.bid.amount, this.sale.event.buy_in);
       }

    }
    changeMarkup(){
        if(this.bid.share != null){
            this.bid.amount = this.BidsService.calcAmount(this.bid.markup, this.bid.share, this.sale.event.buy_in);
        } else {
            this.bid.share = this.BidsService.calcShare(this.bid.markup, this.bid.amount, this.sale.event.buy_in);
        }
    }



    stopBodyScrolling (bool) {
        if (bool === true) {
            document.getElementsByClassName('fullscreen')[0].addEventListener("touchmove", this.freezeVp, false);

        } else {
            document.getElementsByClassName('fullscreen')[0].removeEventListener("touchmove", this.freezeVp, false);
        }
    };


    freezeVp ($event) {
        console.log($event);
        $event.preventDefault();
        $event.stopPropagation();
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
