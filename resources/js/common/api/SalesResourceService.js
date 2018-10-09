import {SALE_MY, SALE_MY_ACTIVE, SALE_MY_CLOSED, SALE_CLOSED, SALE_LOWEST, SALE_ACTIVE} from "../Constants"

class SalesResourceService {
    constructor($http){
        this.$http = $http;
    }

    getMySales(user_id, limit = null) {
        return this.$http.post(SALE_MY, {user_id: user_id, limit: limit});
    }
    getMySalesActive(user_id) {
        return this.$http.post(SALE_MY_ACTIVE, {status: SALE_ACTIVE, user_id: user_id});
    };
    getMySalesClosed(user_id) {
        return this.$http.post(SALE_MY_CLOSED, {status: SALE_CLOSED, user_id: user_id});
    };
}
SalesResourceService.$inject = ['$http'];

export {SalesResourceService};