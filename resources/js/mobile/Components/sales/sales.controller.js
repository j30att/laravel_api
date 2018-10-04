class Sales {
    constructor(ngDialog, $scope) {
        this.$scope = $scope;
        this.show = false;
        this.item = null;
    }


    $onInit() {
    }

    click(key){
        this.show = true;
        this.item = this.sales[key];
    }
}

Sales.$inject = ['ngDialog', '$scope'];

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
