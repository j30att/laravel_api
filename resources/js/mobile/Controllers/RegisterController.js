import {REGISTER_URL} from "../Constants";

class RegisterController {
    constructor($window, $http, RegistrationService, CountriesResourceService){
        this.CountriesResourceService = CountriesResourceService;
        this.RegistrationService = RegistrationService;
        this.$window = $window;
        this.$http = $http;
        this.userName ='';
        this.userEmail ='';
        this.userPassword ='';
        this.passwordConfirmation ='';
        this.userAge ='';
        this.user ={};
        this.state = {
            status: 'register',
            step: 1
        };
        this.getCountries();
    }


    nextState(step){
        console.log(this.state);
        this.state.step = step;
        console.log(this.state);
    }

    getCountries() {
        this.CountriesResourceService.getCountries().then((response) => {
            this.countries = response.data.data;
        });
    }

    validateAge() {
        if (this.user.dateOfBirth) {
            let today = new Date(),
                userDateBirth = this.user.dateOfBirth;

            const dayDiff = today.getDate() - userDateBirth.getDate(),
                monthDiff = today.getMonth() - userDateBirth.getMonth(),
                yearDiff = today.getFullYear() - userDateBirth.getFullYear();

            if (yearDiff > 18 || (yearDiff === 18 && (monthDiff > 0 || (monthDiff === 0 && dayDiff >= 0)))) {
                return true;
            }
        }

        return false;
    }

    sendRegisterForm(){
        let user = {
            name                    : this.user.firstName + ' ' +this.user.lastName,
            birth_date              : this.user.dateOfBirth,
            email                   : this.user.email,
            password                : this.user.password,
            password_confirmation   : this.user.confirmPassword,
            country_id              : this.user.country_id,
            sms_subscribe           : 1,
            email_subscribe         : 1
        };

        this.RegistrationService.createUser(user).then((response)=>{
            if (response.status === 200) {
                this.state.status = 'link';
            } else {
                console.log(response);
            }
        });

    }


};

RegisterController.$inject = ['$window', '$http', 'RegistrationService', 'CountriesResourceService'];

export {RegisterController};
