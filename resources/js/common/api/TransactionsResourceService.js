import {TRANSACTION_LIST} from "../Constants";

class TransactionsResourceService {
    constructor($http) {
        this.$http = $http;
    }

    getTransactions(filter) {
        return this.$http.post(TRANSACTION_LIST, {'filter': filter});
    }

}

TransactionsResourceService.$inject = ['$http'];

export {TransactionsResourceService};
