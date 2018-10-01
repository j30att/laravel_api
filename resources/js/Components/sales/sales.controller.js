class Sales {

    constructor() {

    }

    $onInit() {

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
