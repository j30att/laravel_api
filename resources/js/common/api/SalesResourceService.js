import {
    SALE_API,
    SALE_MY,
    SALE_MY_ACTIVE,
    SALE_MY_CLOSED,
    SALE_CLOSED,
    SALE_ACTIVE,
    SALE_CLOSING_SOON,
    SALE_CREATE,
    SALE_INDEX,
    SALE_PAY_REMAING,
    SALE_BID_CONFIRM,

} from "../Constants"
import {SALE_APLLY_BID, SALE_UPDATE} from "../../mobile/Constants";


class SalesResourceService {
    constructor($http) {
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

    getClosingSoonSales(filter = null) {
        return this.$http.post(SALE_CLOSING_SOON, filter);
    };

    getFilteredSales(filter) {
        return this.$http.post(SALE_API + '/filtered', {filter: filter});
    };

    createMySale(sale, type) {

        return this.$http.post(SALE_CREATE, {sale, type});
    }

    updateMySale(sale){
        return this.$http.post(SALE_UPDATE, {sale});
    }

    payRemaining(sale, remaining){
        return this.$http.post(SALE_PAY_REMAING, {sale:sale, remaining:remaining})
    }

    bidConfirm(bid){
        return this.$http.post(SALE_BID_CONFIRM, {bid});
    }

    getSaleById(id) {
        return this.$http.get(SALE_INDEX + '/' + id);
    };



}

SalesResourceService.$inject = ['$http'];

export {SalesResourceService};
