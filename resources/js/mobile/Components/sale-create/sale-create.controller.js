import {EVENTS_API, SALE_ACTIVE, SUBEVENTS_INDEX} from "../../../common/Constants";


class SaleCreate {
    constructor($scope,SalesResourceService, $mdSidenav, $http, SalesService, $timeout, $state, $mdDialog) {
        this.$state = $state;
        this.$scope = $scope;
        this.$mdDialog = $mdDialog;

        this.SalesResourceService = SalesResourceService;
        this.SalesService = SalesService;
        this.$mdSidenav = $mdSidenav;
        this.$timeout=$timeout;
        this.$http = $http;
        this.user = window.__user;
        this.static = {
            buy_in: null,
            closing_time: null
        };
        this.sale = {
            user_id: this.user.id,
            event_id: null,
            sub_event_id: null,
            status: SALE_ACTIVE,
            share: null,
            markup: null,
            amount: null,
        };
        this._opts = {fixed: false};
        this.isSidenavOpen =false;
    }

    $onInit(){
        this.$scope.$on('sidenav-open', (event, data) => {
            this.buildToggler('right');
        });

        this.$scope.$watch('isSidenavOpen', (fixed) => {
            this.$state.modalOpened = fixed
        });

    }

    buildToggler(componentId) {
        this.getEvents();
        this.$mdSidenav(componentId).toggle();
        if(this.$mdSidenav(componentId).isOpen()){
            this.$state.modalOpened = true;
        } else {this.$state.modalOpened = false}
    }

    getEvents() {
        this.$http.get(EVENTS_API)
            .then(response => {
                this.events = response.data.data;
            });
    }

    getSubevents() {
        this.fillStatic();
        this.$http.get(SUBEVENTS_INDEX, {params: {event_id: this.sale.event_id}})
            .then(response => {
                this.subevents = response.data.data;
            });
    }

    fillStatic() {
        let self;
        self = this;
        this.events.forEach(function (value, key) {
            if (value.id == self.sale.event_id) {
                self.static.buy_in = value.buy_in;
                self.static.closing_time = value.date;
            }
        });
    }
    calcAmount() {
        this.sale.amount = this.SalesService.calcAmount(this.sale.share, this.sale.markup, this.static.buy_in);
    }

    validate(){
        if(this.sale.event_id == null
            || this.sale.sub_event_id == null
            || this.sale.share == null
            || this.sale.markup == null
            || this.sale.amount == null
            || this.sale.user_id == null
        ){
            console.log('validate faild');
            return false
        }
        return true;
    }

    /*showSaleConfirm(sale) {
        let confirm = this.$mdDialog.confirm()
            .parent(angular.element(document.querySelector('[md-component-id="right"]')))
            .htmlContent(
                `
                <div>Are you sure?</div>`)
            .ok('Accept')
            .cancel('Cancel');

        this.$mdDialog.show(confirm).then(() => {
        }, () => {});
    }*/

    createSale(){
        if(!this.validate()) return false;
        this.SalesResourceService.createMySale(this.sale).then(response => {
            if (response.data.status == 1){
             //   this.showErorModal('right');
            } else {

            }

        });

    }

    close(componentId){
        this.$mdSidenav(componentId).close();
    }

};

SaleCreate.$inject = ['$scope', 'SalesResourceService', '$mdSidenav', '$http', 'SalesService', '$timeout', '$state', '$mdDialog'];

export const SaleCreateComponent = {
    bindings: {
        func:     '&',
    },
    template: require('./sale-create.template.html'),
    controller: SaleCreate,
    controllerAs: '$ctrl'
};
