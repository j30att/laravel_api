class Bids {

    constructor() {
    console.log(this.bids);
    }

    $onInit() {

    }

}

export const BidsComponent = {
    bindings: {
        bids:    '<',
        state:   '<'
    },
    template: require('./bids.template.html'),
    controller: Bids,
    controllerAs: '$ctrl'
};
