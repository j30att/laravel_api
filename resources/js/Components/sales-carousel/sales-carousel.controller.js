class SalesCarousel {

    constructor() {
    }

    $onInit() {
    }

}

export const SalesCarouselComponent = {
    bindings: {
        sales: '<',
        state:  '<',
    },
    template: require('./sales-carousel.template.html'),
    controller: SalesCarousel,
    controllerAs: '$ctrl'
};
