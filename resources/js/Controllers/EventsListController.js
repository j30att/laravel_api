class EventsListController {
    constructor($window, $http) {
        this.$window = $window;
        this.$http = $http;
        this.opened = [];
        this.opened.push(window.events[0].id);

    }

    openDetail(event_id) {
        let rInd = this.opened.indexOf(event_id);
        if (rInd === -1) {
            this.opened.push(event_id);
        } else {
            this.opened.splice(rInd, 1);
        }
    }

    showDetail(event_id) {
        if (this.opened.indexOf(event_id) != -1) {
            return true;
        } else {
            return false;
        }
    }

};

EventsListController.$inject = ['$window', '$http'];

export {EventsListController};
