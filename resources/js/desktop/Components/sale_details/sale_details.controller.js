
class SaleDetails {
    constructor($scope,SalesResourceService, $mdSidenav, $http, SalesService, $timeout, $state, $mdDialog, DealerWinController) {
        this.SalesResourceService = SalesResourceService;
        this.SalesService = SalesService;
        this.DealerWinController = DealerWinController;
        this.$mdSidenav = $mdSidenav;
        this.$mdDialog = $mdDialog;
        this.$timeout=$timeout;
        this.$state = $state;
        this.$scope = $scope;
        this.$http = $http;
        this.user = window.__user;
        this._opts = {fixed: false};
        this.isSidenavOpen =false;

    }

    toggleUserDetails(){
        this.$scope.$broadcast('sidenav-userDetails-open', this.sale.creator.id);
    }

    toggleLogDetails(){
        this.$scope.$broadcast('sidenav-logDetails-open');

    }


    $onInit(){
        this.$scope.$on('sidenav-saleDetails-open', (event, data) => {
            if (data){
                this.sale = data;
            }

            this.buildToggler('right_sale_details');
        });

        this.$scope.$watch('isSidenavOpen', (fixed) => {
            this.$state.modalOpened = fixed
        });

    }



    buildToggler(componentId) {
        this.$mdSidenav(componentId).toggle();
    }


    close(componentId){
        this.$mdSidenav(componentId).close();
    }

    showLosePopUp(){

        let confirm = this.$mdDialog.confirm()
            .parent(angular.element(document.querySelector('[md-component-id="right_sale_details"]')))
            .title('Confirm your action')
            .textContent('Are you sure that ' + this.user.name +' lose this game?\n' +
                'You can’t be able to change this action later!')
            .ok('Confirm')
            .cancel('Cancel');
        this.$mdDialog.show(confirm).then(() => {

        }, () => {
        });

        setTimeout(function () {
            let buttonConf = document.getElementsByClassName('md-confirm-button')[0];
            buttonConf.setAttribute('style', 'background-color:#ff3700 !important');
        }, 10);


    }
    showLeftPopUp(){
        let confirm = this.$mdDialog.confirm()
            .parent(angular.element(document.querySelector('[md-component-id="right_sale_details"]')))
            .title('Confirm your action')
            .textContent('Are you sure that ' + this.user.name +' left this game?\n' +
                'You can’t be able to change this action later!')
            .ok('Confirm')
            .cancel('Cancel');

        this.$mdDialog.show(confirm).then(() => {

        }, () => {
        });

        setTimeout(function () {
            let buttonConf = document.getElementsByClassName('md-confirm-button')[0];
            buttonConf.setAttribute('style', 'background-color:#999999 !important');
        }, 10);
    }

    showWonPopUp (ev){
        console.log('hui');
        this.$mdDialog.show({
            controller: this.DealerWinController,
            template: require('./won.tmpl.html'),
            parent: angular.element(document.querySelector('[md-component-id="right_sale_details"]')),
            targetEvent: ev,
            clickOutsideToClose:true,
        })

            .then(function() {
                this.$scope.status = 'You said the information was "' + 'answer' + '".';
            }, function() {
                this.$scope.status = 'You cancelled the dialog.';
            });


    }




};

SaleDetails.$inject = ['$scope', 'SalesResourceService', '$mdSidenav', '$http',
    'SalesService', '$timeout', '$state', '$mdDialog'];

export const SaleDetailsComponent = {
    bindings: {

    },
    template: require('./sale_details.template.html'),
    controller: SaleDetails,
    controllerAs: '$ctrl'
};
