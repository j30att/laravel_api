class BidsRow {

    constructor() {

    }

    $onInit() {

    }

}

export const BidsRowComponent = {
    bindings: {
        bids:    '<',
    },
    template: require('./bids-row.template.html'),
    controller: BidsRow,
    controllerAs: '$ctrl'
};
