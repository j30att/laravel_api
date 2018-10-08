class Sales {
    constructor($state) {
        this.$state = $state;
        this.show = false;
        this.item = null;
    }


    $onInit() {
    }

    click(key){
        this.show = true;
        this.$state.modalOpened = this.show;
        this.item = this.sales[key];
    }
}

Sales.$inject = ['$state'];


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
