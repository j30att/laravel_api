class Events {

    constructor() {
        this.opened = [] ;
    }

    $onInit() {

    }

    openDetail (event_id){
        let rInd = this.opened.indexOf(event_id);
        if (rInd === -1){
            this.opened.push(event_id);
        } else{
            this.opened.splice(rInd,1);
        }
    }

    showDetail(event_id){
        if (this.opened.indexOf(event_id) != -1){
            return true;
        } else {
            return false;
        }

    }

}

export const EventsComponent = {
    bindings: {
        events:    '<',
        state:     '<',
    },
    template: require('./events.template.html'),
    controller: Events,
    controllerAs: '$ctrl'
};
