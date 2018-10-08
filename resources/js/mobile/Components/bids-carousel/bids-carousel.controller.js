class BidsCarousel {

    constructor() {

    }

    $onInit() {

    }

}

export const BidsCarouselComponent = {
    bindings: {
        bids: '<',
    },
    template: require('./bids-carousel.template.html'),
    controller: BidsCarousel,
    controllerAs: '$ctrl'
};
