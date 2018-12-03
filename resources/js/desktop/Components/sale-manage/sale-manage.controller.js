import {SalesResourceService} from "../../../common/api/SalesResourceService";

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

        this.sale = {};
        this.disabled = true;

    }



    $onInit() {
        this.$scope.$on('sidenavManage-open', (event, data) => {
            if (data) {
                this.sale = data;
                this.calcPayRemaining();
                this.buildToggler('right_manage');
            }
        });
        this.$scope.$watch('isSidenavOpen', (fixed) => {
            this.$state.modalOpened = fixed
        });
    }

    enableEdti(e){
        this.disabled = false;

        this.$timeout().then(()=>{
            setTimeout(100);
            this.enableFocus();
        });


    }

    enableFocus(){
        angular.element(document.querySelector('[id="focused"]')).focus();
    }




    buildToggler(componentId) {
        this.$mdSidenav(componentId).toggle();
        if (this.$mdSidenav(componentId).isOpen()) {
            this.$state.modalOpened = true;
        } else {
            this.$state.modalOpened = false
        }
    }

    close(componentId) {
        this.$mdSidenav(componentId).close();
    }


    showBidsConfirm(bid) {
        console.log(bid);
        let confirm = this.$mdDialog.confirm()
            .parent(angular.element(document.querySelector('[md-component-id="right_manage"]')))
            .htmlContent(
                `<div class="bids_group_blue">
                    <span>${bid.markup}</span>
                    <span>${bid.share}%</span>
                    <span>$${bid.amount}</span>
                </div>
                <div>Accept bid. Your markup will be decreased to ${bid.markup} to accept all bids</div>`)
            .ok('Accept')
            .cancel('Cancel');

        this.$mdDialog.show(confirm).then(() => {

            this.SalesResourceService.bidConfirm(bid).then((response)=>{

                this.sales = response.data.data;
                this.sales['active'].forEach((item)=>{
                    if (item.id == bid.sale_id)
                    this.sale = item;
                })

            })
        }, () => {});
    }

    acceptChangeSale(event, sale){
        if (event.keyCode === 13) {
            this.showSaleConfirm(sale);
        }
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

        this.$mdDialog.show(confirm).then(
            () => {
                this.SalesResourceService.updateMySale(this.sale);
            },
            () => {});
    }

    showPayConfirm(sale) {
        let confirm = this.$mdDialog.confirm()
            .parent(angular.element(document.querySelector('[md-component-id="right_manage"]')))
            .htmlContent(`<div><span>This changes will hold</span> $ ${this.payRemainig} <span>in your account. Continue?</span></div>`)
            //.textContent(`This changes will hold $3,234 in your account. Continue?`)
            .ok('Accept')
            .cancel('Cancel');

        this.$mdDialog.show(confirm).then(() => {
            this.SalesResourceService.payRemaining(this.sale, this.payRemainig)
                .then((response) => {
                    this.sales = response.data.data;
                });
            this.$mdSidenav('right_manage').close();
        }, () => {});
    }

    calcPayRemaining(){
        this.payRemainig = ((parseFloat(this.sale.event.buy_in)*100) - (parseFloat(this.sale.amount_raised) * 100))/100;
    }
}

SaleManage.$inject = ['$scope', 'SalesResourceService', '$mdSidenav', '$http', 'SalesService', '$timeout', '$state', '$mdDialog'];

export const SaleManageComponent = {
    bindings: {
        sales: '=',
        type: '='
    },
    template: require('./sale-manage.template.html'),
    controller: SaleManage,
    controllerAs: '$ctrl'
};
