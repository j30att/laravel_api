import {REGISTRATION_URL, CHECK_EMAIL_URL} from "../Constants";

class RegistrationService {
    constructor($http) {
        this.$http = $http;
    }

    createUser(data) {
        return this.$http.post(REGISTRATION_URL, data)
    }

    checkEmail(email) {
        return this.$http.post(CHECK_EMAIL_URL, {'email': email})
    }

}

RegistrationService.$inject = ['$http'];
export {RegistrationService};
