import {SaleFormController} from "../../../desktop/Controllers/SaleFormController";

class Events {

    constructor($window, $state) {
        this.opened = [] ;
        this.$window = $window;
        this.$state = $state;

    }

    $onInit() {

    }

    openDetail (event_id){
        // console.log(event_id, 'event_id');
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
    hideArrow(event_id){
        if (this.opened.indexOf(event_id) != -1){
            return false;
        } else {
            return true;
        }

    }
    showSubEventInfo(event_id, subevent_id){
        this.$state.subevent_id = subevent_id;
        this.$state.go('events-info', {id:event_id});
    }

}
Events.$inject = ['$window', '$state'];
export const EventsComponent = {
    bindings: {
        events:    '<',
        state:     '<',
    },
    template: require('./events.template.html'),
    controller: Events,
    controllerAs: '$ctrl'
};
