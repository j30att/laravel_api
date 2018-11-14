import {DEALER_EVENTS_DETAIL_URL, DEALER_EVENTS_URL, DEALER_USERS_URL, DEALER_PROFILE_URL, RESULT} from "../Constants"


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

    getSales(id){
        return this.$http.post(DEALER_PROFILE_URL,{id:id})
    }

    sendResult(result){
        return this.$http.post(RESULT, {result});
    }


}
DealerResourceService.$inject = ['$http'];
export {DealerResourceService};
