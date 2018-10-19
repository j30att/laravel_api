import {SUB_EVENTS_API} from "../Constants";

class SubEventsResourceService {
    constructor($http) {
        this.$http = $http;
    }

    getSubEvents(params) {
        return this.$http.get(SUB_EVENTS_API, params);
    }
}

SubEventsResourceService.$inject = ['$http'];

export {SubEventsResourceService};