class Sales {
    constructor($state, $scope) {
        this.$state = $state;
        this.$scope = $scope;
        this.showPlace = false;
        this.showManage = false;
        this.item = null;
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

export {Sales}
