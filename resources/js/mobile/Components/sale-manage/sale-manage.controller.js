import {BID_MATCHED} from "./../../../common/Constants"

class SaleManage {
    constructor($scope, SalesResourceService, $mdSidenav, $http, SalesService, $timeout, $state, $mdDialog) {
        this.SalesResourceService = SalesResourceService;
        this.SalesService = SalesService;
        this.$mdSidenav = $mdSidenav;
        this.$timeout = $timeout;
        this.$state = $state;
        this.$scope = $scope;
        this.$http = $http;
        this.$mdDialog = $mdDialog;

        this.user = window.__user;
        this._opts = {fixed: false};
        this.isSidenavOpen = false;
        this.sale = null;
    }

    $onInit() {
        this.$scope.$on('sidenavManage-open', (event, data) => {
            if (data) {
                this.sale = data;
                this.buildToggler('right_manage');
            }

        });
        this.$scope.$watch('isSidenavOpen', (fixed) => {
            this.stopBodyScrolling(fixed);
            this.$state.modalOpened = fixed
        });

    }

    buildToggler(componentId) {
        this.$mdSidenav(componentId).toggle();
        if (this.$mdSidenav(componentId).isOpen()) {
            this.$state.modalOpened = true;
        } else {
            this.$state.modalOpened = false
        }
    }

    setState(action = null) {

        console.log(this.sale, 'this.salethis.salethis.salethis.salethis.sale');
        this._opts.stateCreate = !this._opts.stateCreate;
        if (action == 'store') this.updateSale(this.sale);
    }

    close(componentId) {
        this.$mdSidenav(componentId).close();
    }

    showBidsConfirm(bid) {
        let confirm = this.$mdDialog.confirm()
            .parent(angular.element(document.querySelector('[md-component-id="right_manage"]')))
            .htmlContent(
                `<div class="bids_group_blue">
                    <span>${bid.markup}</span>
                    <span>${bid.share}%</span>
                    <span>$${bid.amount}</span>
                </div>
                <div>Accept bid. Your markup will be decreased to 1.1 to accept all bids</div>`)
            .ok('Accept')
            .cancel('Cancel');

        this.$mdDialog.show(confirm).then(() => {
            this.sale.bids.forEach((item) => {
                if (item.id === bid.id) {
                    item.status = 2;
                }
            });
        }, () => {
        });
    }

    showSaleConfirm(sale) {
        let confirm = this.$mdDialog.confirm()
            .parent(angular.element(document.querySelector('[md-component-id="right_manage"]')))
            .htmlContent(
                `<div class="bids_group_blue">
                    <span>${sale.markup}</span>
                    <span>${sale.share}%</span>
                    <span>$${sale.amount}</span>
                </div>
                <div>Are you sure?</div>`)
            .ok('Accept')
            .cancel('Cancel');

        this.$mdDialog.show(confirm).then(() => {
        }, () => {
        });
    }

    showPayConfirm(sale) {
        let confirm = this.$mdDialog.confirm()
            .parent(angular.element(document.querySelector('[md-component-id="right_manage"]')))
            .textContent(`This changes will hold $3,234 in your account. Continue?`)
            .ok('Accept')
            .cancel('Cancel');

        this.$mdDialog.show(confirm).then(() => {
            this.$mdSidenav('right_manage').close();
        }, () => {
        });
    }


    stopBodyScrolling(bool) {
        if (bool === true) {
            document.querySelector(".container").addEventListener('touchmove', function (event) {
                if (document.querySelector(".container") !== event.target) return;
                event.preventDefault();
            });
        }
        ;


    }

    updateSale() {
        let sale = {
            id: this.sale.id,
            share: this.sale.share,
            markup: this.sale.markup,
            amount: this.sale.amount

        };
        this.SalesResourceService.updateMySale(sale).then(response => {
            console.log('hui');
        })
    }

    apllyBid(bid) {
        let data = {
            sale_id: this.sale.id,
            bid: bid
        };
        this.SalesResourceService.apllyMyBid(data).then(response => {
            this.sale = response.data.data;
        })

    }

    showAmountRaised() {
        return this.SalesService.calcAmountRaised(this.sale);
    };

    showShareSold() {
        return this.SalesService.calcShareSold(this.sale);
    }

}

SaleManage.$inject = ['$scope', 'SalesResourceService', '$mdSidenav', '$http', 'SalesService', '$timeout', '$state', '$mdDialog'];

export const SaleManageComponent = {
    template: require('./sale-manage.template.html'),
    controller: SaleManage,
    controllerAs: '$ctrl'
};
