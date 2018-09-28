class EventsCarousel {

    constructor() {
        console.log(this.events);
        console.log(this.state);
    }

    $onInit() {

    }

}

export const EventsCarouselComponent = {
    bindings: {
        events: '<',
        state:  '<',
    },
    template: require('./events-carousel.template.html'),
    controller: EventsCarousel,
    controllerAs: '$ctrl'
};
