class Registration {
    constructor($scope, $mdSidenav, $state, CountriesResourceService, RegistrationService) {
        this.$scope = $scope;
        this.$mdSidenav = $mdSidenav;
        this.$state = $state;
        this._opts = {fixed: false};
        this.isSidenavOpen = false;
        this.user = {
            firstName: null,
            lastName: null,
            dateOfBirth: null,
            email: null,
            password: null,
            confirmPassword: null,
            country_id: null,
            checkBoxSms: true,
            checkBoxEmail: true
        };
        this.prevState = null;
        this.CountriesResourceService = CountriesResourceService;
        this.RegistrationService = RegistrationService;

        this.errorMessages = {
            'confirmPassword': 'Password does not match the confirm password.',
        };

        this.getCountries();
    }

    $onInit() {
        this.$scope.$on('sidenav-registration-open', (event, data) => {
            this.state = data.state;
            this.buildToggler('right_registration');
            this._opts.opened = true;
        });

        this.$scope.$watch('isSidenavOpen', (fixed) => {
            this.$state.modalOpened = fixed
        });
    }

    getCountries() {
        this.CountriesResourceService.getCountries()
            .then((response) => {
                this.countries = response.data.data;
            });
    }

    changeState(state) {
        this.prevState = this.state;
        this.state = state;
    }

    goBack() {
        if (this.prevState === null) {
            this.buildToggler('right_registration');
        }
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
        if (this.secondStepValidate()) {
            this.state = 'confirm_privacy';
        }
    }

    firstStepValidate() {
        const validateFirstName = this.validateFirstName(),
            validateLastName = this.validateLastName(),
            validateDateOfBirth = this.validateDateOfBirth(),
            validateLocation = this.validateLocation();

        return (
            validateFirstName
            && validateLastName
            && validateDateOfBirth
            && validateLocation
        )
    }

    secondStepValidate() {
        const validateEmail = this.validateEmail(),
            validatePassword = this.validatePassword(),
            validateConfirmPassword = this.validateConfirmPassword();

        return (
            validateEmail
            && validatePassword
            && validateConfirmPassword
        )
    }

    validateFirstName() {
        this._opts.validateFirstName = false;

        if (this.user.firstName === null || this.user.firstName.length < 2) {
            this._opts.validateFirstName = true;
            return false;
        }

        return true;
    }

    validateLastName() {
        this._opts.validateLastName = false;

        if (this.user.lastName === null || this.user.lastName.length < 2) {
            this._opts.validateLastName = true;
            return false;
        }

        return true;
    }

    validateDateOfBirth() {
        this._opts.validateBirthDate = false;

        if (this.user.dateOfBirth === null) {
            this._opts.validateBirthDate = true;
            return false;
        }

        return true;
    }

    validateLocation() {
        this._opts.validateLocation = false;

        if (this.user.country_id === null || this.user.country_id === undefined) {
            this._opts.validateLocation = true;
            return false;
        }

        return true;
    }

    validateEmail() {
        this._opts.validateEmail = false;

        if (this.user.email === null || this.user.email.length < 6) {
            this._opts.validateEmail = true;
            return false;
        }

        return true;
    }

    validatePassword() {
        this._opts.validatePassword = false;

        if (this.user.password === null || this.user.password.length < 6) {
            this._opts.validatePassword = true;
            return false;
        }

        return true;
    }

    validateConfirmPassword() {
        this._opts.validateConfirmPassword = false;

        if (this.user.confirmPassword !== this.user.password) {
            this._opts.validateConfirmPassword = this.errorMessages.confirmPassword;
            return false;
        }

        return true;
    }

    createUser() {
        let user = {
            name: this.user.firstName + ' ' + this.user.lastName,
            birth_date: this.user.dateOfBirth,
            email: this.user.email,
            password: this.user.password,
            password_confirmation: this.user.confirmPassword,
            country_id: this.user.country_id,
            sms_subscribe: this.user.checkBoxSms,
            email_subscribe: this.user.checkBoxEmail
        };

        this.RegistrationService.createUser(user)
            .then((response) => {
                if (response.status === 200) {
                    this.changeState('link_pp_account');
                } else {
                    console.log(response);
                }
            });
    }
}

Registration.$inject = ['$scope', '$mdSidenav', '$state', 'CountriesResourceService', 'RegistrationService'];

export const RegistrationComponent = {
    bindings: {},
    template: require('./registration.template.html'),
    controller: Registration,
    controllerAs: '$ctrl'
};
