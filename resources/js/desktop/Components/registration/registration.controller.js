class Registration {
    constructor($scope, SalesResourceService, $mdSidenav, $http,
                SalesService, $timeout, $state, CountriesResourceService, RegistrationService) {
        this.$mdSidenav = $mdSidenav;
        this.$timeout = $timeout;
        this.$state = $state;
        this.$scope = $scope;
        this.$http = $http;
        this._opts = {fixed: false};
        this.isSidenavOpen = false;
        this.user = {
            firstName       : null,
            lastName        : null,
            dateOfBirth     : undefined,
            email           : null,
            password        : null,
            confirmPassword : null,
            country_id      : null,
            checkBoxSms     : true,
            checkBoxEmail   : true
        };
        this.prevState = null;
        this.CountriesResourceService = CountriesResourceService;
        this.RegistrationService = RegistrationService;
        this.getCountries();
        //this.createUser();

    }

    $onInit() {
        this.$scope.$on('sidenav-registration-open', (event, data) => {
            this.state = data.state;
            this.buildToggler('right_registration');
            this._opts.opened = true;
            console.log(this.user, 'user');
        });

        this.$scope.$watch('isSidenavOpen', (fixed) => {
            this.$state.modalOpened = fixed
        });
    }


    getCountries() {
        this.CountriesResourceService.getCountries().then((response) => {
            this.countries = response.data.data;
        });
    }


    changeState(state) {
        this.prevState = this.state;
        this.state = state;
    }

    goBack() {
        if (this.prevState == null) this.buildToggler('right_registration');
        this.state = this.prevState;
    }

    buildToggler(componentId) {
        this.$mdSidenav(componentId).toggle();
    }

    close(componentId) {
        this.$mdSidenav(componentId).close();
    }

    secondStep() {

        if (this.firstStepValidate()) {
            this.state = 'register_password';
        }

    }

    thirdStep() {
        if (this.secondStepValidate())
        this.state = 'confirm_privacy';
        console.log(this.user);
    }




    firstStepValidate() {
        this._opts.validateFirstName = false;
        this._opts.validateLastName = false;
        this._opts.validateBirthDate = false;
        this._opts.validateLocation = false;
        let validate = 0;

        if (this.validateFirstName()) validate ++ ;
        if (this.validateLastName()) validate  ++;
        if (this.validatedateOfBirth()) validate ++;
        if (this.validateLocation()) validate ++;



        if (validate > 3){
            return true;
        } else {
            return false;
        }

    }

    secondStepValidate() {
        this._opts.validateEmail = false;
        this._opts.validatedatePassword = false;
        this._opts.validatedateConfirmPassword = false;

        let validate = 0;

        if (this.validatedateEmail()) validate ++ ;
        if (this.validatedatePassword()) validate ++ ;
        if (this.validatedateConfirmPassword()) validate ++ ;

        if (validate > 2){
            return true;
        } else {
            return false;
        }
    }

    validateFirstName() {
        if (this.user.firstName == null || this.user.firstName.length < 2){
            this._opts.validateFirstName = true;
            return false;
        }
        return true;
    }

    validateLastName() {
        if (this.user.lastName == null || this.user.lastName.length < 2){
            this._opts.validateLastName = true;
            return false;
        }
        return true;
    }

    validatedateOfBirth() {
        if (this.user.dateOfBirth == null){
            this._opts.validateBirthDate = true;
            return false;
        }
        return true;
    }

    validateLocation() {
        if (this.user.country_id == null || this.user.country_id == undefined){
            this._opts.validateLocation = true;
            return false;
        }
        return true;
    }

    validatedateEmail(){
        if (this.user.email == null || this.user.email.length < 6){
            this._opts.validateEmail = true;
            return false;
        }
        return true;
    }

    validatedatePassword(){
        if (this.user.password == null || this.user.password.length < 6){
            this._opts.validatePassword = true;
            return false;
        }
        return true;
    }

    validatedateConfirmPassword(){
        if (this.user.confirmPassword != this.user.password){
            this._opts.validateConfirmPassword = true;
            return false;
        }
        return true;
    }

    createUser(){

        let user = {
            name                    : this.user.firstName + ' ' +this.user.lastName,
            birth_date              : this.user.dateOfBirth,
            email                   : this.user.email,
            password                : this.user.password,
            password_confirmation   : this.user.confirmPassword,
            country_id              : this.user.country_id,
            sms_subscribe           : this.user.checkBoxSms,
            email_subscribe         : this.user.checkBoxEmail
        };

         this.RegistrationService.createUser(user).then((response)=>{
             if (response.status === 200) {
                 this.changeState('link_pp_account');
             } else {
                 console.log(response);
             }
         });
    }

};

Registration.$inject = ['$scope', 'SalesResourceService', '$mdSidenav',
    '$http', 'SalesService', '$timeout', '$state', 'CountriesResourceService', 'RegistrationService'];

export const RegistrationComponent = {
    bindings: {},
    template: require('./registration.template.html'),
    controller: Registration,
    controllerAs: '$ctrl'
};
