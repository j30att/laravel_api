import {DEALER_CURRENCY_URL} from "../Constants"


class CurrencyResourceService {
    constructor($http){
        this.$http = $http;
    }

    getCurrency(){
        return this.$http.post(DEALER_CURRENCY_URL,{})
    }



}
CurrencyResourceService.$inject = ['$http'];
export {CurrencyResourceService};
