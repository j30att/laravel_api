class BidsCarousel {

    constructor() {

    }

    $onInit() {
        console.log(this.bids);
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
