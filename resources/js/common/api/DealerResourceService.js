import {DEALER_EVENTS_DETAIL_URL, DEALER_EVENTS_URL, DEALER_USERS_URL} from "../Constants"


class DealerResourceService {
    constructor($http){
        this.$http = $http;
     }

    getEvents(){
        return this.$http.post(DEALER_EVENTS_URL,{})
    }

    getEvent(id){
        return this.$http.post(DEALER_EVENTS_DETAIL_URL,{id:id})
    }

    getUsers(){
        return this.$http.post(DEALER_USERS_URL,{})
    }

}
DealerResourceService.$inject = ['$http'];
export {DealerResourceService};