class Sales {

    constructor() {

    }

    $onInit() {

    }

    click(){
        console.log(this.sales);
    }

}

export const SalesComponent = {
    bindings: {
        sales:    '<',
        state:     '<',
    },
    template: require('./sales.template.html'),
    controller: Sales,
    controllerAs: '$ctrl'
};
