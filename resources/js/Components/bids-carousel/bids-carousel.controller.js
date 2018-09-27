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
        menu: '<',
    },
    template: require('./bids-carousel.template.html'),
    controller: BidsCarousel,
    controllerAs: '$ctrl'
};
