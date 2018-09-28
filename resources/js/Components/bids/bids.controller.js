class Bids {

    constructor() {

    }

    $onInit() {

    }

}

export const BidsComponent = {
    bindings: {
        bids:    '<',
    },
    template: require('./bids.template.html'),
    controller: Bids,
    controllerAs: '$ctrl'
};
