import {EVENTS_API} from "../Constants";

class EventsResourceService {
    constructor($http) {
        this.$http = $http;
    }

    getEvents() {
        return this.$http.get(EVENTS_API);
    }

    getMainEvents() {
        return this.$http.get(EVENTS_API + '/main');
    }

    getFilteredEvents(filter) {
        return this.$http.post(EVENTS_API + '/filtered', {filter: filter});
    };

    getEventById(id) {
        return this.$http.get(EVENTS_API + '/' + id);
    };

    getFilters() {
        return this.$http.get(EVENTS_API + '/get-filters');
    }
}

EventsResourceService.$inject = ['$http'];

export {EventsResourceService};