import {BIDS_MY, DEALER_EVENTS_URL, DEALER_USERS_URL} from "../Constants"


class DealerResourceService {
    constructor($http){
        this.$http = $http;
     }

    getEvents(){
        console.log(1111);
        return this.$http.post(DEALER_EVENTS_URL,{})
    }

    getUsers(){
        return this.$http.post(DEALER_USERS_URL,{})
    }

}
DealerResourceService.$inject = ['$http'];
export {DealerResourceService};