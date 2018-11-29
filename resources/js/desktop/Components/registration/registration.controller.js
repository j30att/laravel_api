class Registration {
    constructor($scope, $mdSidenav, $state, CountriesResourceService, RegistrationService) {
        this.$scope = $scope;
        this.$mdSidenav = $mdSidenav;
        this.$state = $state;
        this._opts = {fixed: false};
        this.isSidenavOpen = false;
        this.linkUrl = window.__linkUrl;

        this.user = {
            firstName: null,
            lastName: null,
            dateOfBirth: undefined,
            email: null,
            password: null,
            confirmPassword: null,
            country_id: window.__location,
            checkBoxSms: true,
            checkBoxEmail: true
        };
        this.prevState = null;
        this.CountriesResourceService = CountriesResourceService;
        this.RegistrationService = RegistrationService;

        this.errorMessages = {
            'passwordInvalid': 'Password must be at least 6 characters.',
            'confirmPasswordInvalid': 'Confirm password must be at least 6 characters.',
            'confirmPasswordDoesNotMatch': 'Password does not match the confirm password.',
            'emailInvalid': 'E-mail address is invalid.',
            'emailAlreadyRegistered': 'User with such email already registered.',
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

    showTerms(prevstate) {
        this.state = 'terms';
        this.previousState = prevstate;
    }

    showPrivacy(prevstate) {
        this.state = 'privacy';
        this.previousState = prevstate;
    }

    hideTerms() {
        if (this.previousState === null) {
            this.buildToggler('right_registration');
        }
        this.state = this.previousState;
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
        this.previousState = null;
    }

    close(componentId) {
        this.$mdSidenav(componentId).close();
    }

    secondStep() {
        if (this.firstStepValidate()) {
            this.state = 'register_password';
        }
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

    thirdStep() {
        if (this.secondStepValidate()) {
            const {email} = this.user;

            this.RegistrationService.checkEmail(email)
                .then(response => {
                    if (response.data.status === 1) {
                        this.state = 'confirm_privacy'
                    } else {
                        this._opts.validateEmail = this.errorMessages.emailAlreadyRegistered
                    }
                });

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

        if (this.user.dateOfBirth === null || !this.validateAge()) {
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
        const {email} = this.user,
            regexp = /[^@]+@[^@]+\.[^@]+/;
        this._opts.validateEmail = false;

        if (!email || (email && !regexp.test(email))) {
            this._opts.validateEmail = this.errorMessages.emailInvalid;
        }

        return !this._opts.validateEmail;
    }

    validatePassword() {
        const {password} = this.user;
        this._opts.validatePassword = false;

        if (!password || (password && password.length < 6)) {
            this._opts.validatePassword = this.errorMessages.passwordInvalid;
        }

        return !this._opts.validatePassword;
    }

    validateConfirmPassword() {
        const {confirmPassword, password} = this.user;
        this._opts.validateConfirmPassword = false;

        if (!confirmPassword) {
            this._opts.validateConfirmPassword = this.errorMessages.confirmPasswordInvalid;
        } else if (confirmPassword !== password) {
            this._opts.validateConfirmPassword = this.errorMessages.confirmPasswordDoesNotMatch;
        }

        return !this._opts.validateConfirmPassword;
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
                    this.changeState('confirm_email');
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
