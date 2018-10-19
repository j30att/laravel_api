import {
    SALE_API,
    SALE_MY,
    SALE_MY_ACTIVE,
    SALE_MY_CLOSED,
    SALE_CLOSED,
    SALE_ACTIVE,
    SALE_CLOSING_SOON,
    SALE_CREATE,
    SALE_INDEX
} from "../Constants"


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

    getClosingSoonSales(user_id = null) {
        return this.$http.post(SALE_CLOSING_SOON, {user_id: user_id});
    };

    getFilteredSales(filter) {
        return this.$http.post(SALE_API + '/filtered', {filter: filter});
    };

    createMySale(sale) {
        return this.$http.post(SALE_CREATE, {sale});
    }

    getSaleById(id) {
        return this.$http.get(SALE_INDEX + '/' + id);
    };
}

SalesResourceService.$inject = ['$http'];

export {SalesResourceService};