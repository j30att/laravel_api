class Sales {
    constructor($state, $scope) {
        this.$state = $state;
        this.$scope = $scope;
        this.showPlace = false;
        this.showManage = false
        this.item = null;
    }


    $onInit() {
    }

    showModal(key, type){
        if(type == 'manage')  this.showManage = true;
        if(type == 'place')   this.showPlace = true;
        this.$state.modalOpened = true;
        this.item = this.sales[key];
    }

    togglePlace(index) {
        this.sale = this.sales[index];
        this.$scope.$broadcast('sidenavPlace-open', () =>{
            console.log('open sidenav')
        });
    }

    toggleManage(index) {

        this.sale = this.sales[index];
        this.$scope.$broadcast('sidenavManage-open', () =>{
            console.log('open sidenav')
        });
    }
}

Sales.$inject = ['$state', '$scope'];


export const SalesComponent = {
    bindings: {
        subevent: '<',
        sales:    '<',
        state:     '<',
    },
    template: require('./sales.template.html'),
    controller: Sales,
    controllerAs: '$ctrl'
};
