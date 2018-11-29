class RegisterController {
    constructor($timeout, $location, RegistrationService, CountriesResourceService) {
        this.CountriesResourceService = CountriesResourceService;
        this.RegistrationService = RegistrationService;
        this.$location = $location;
        this.$timeout = $timeout;
        this.linkUrl = window.__linkUrl;

        this.user = {
            firstName: null,
            lastName: null,
            dateOfBirth: null,
            email: null,
            password: null,
            confirmPassword: null,
            country_id: window.__location,
            checkBoxSms: true,
            checkBoxEmail: true
        };

        this.state = {
            status: 'register',
            step: 1,
            busy: false,
        };

    }

    $onInit() {
        this.getCountries();
    }

    getCountries() {
        this.CountriesResourceService.getCountries().then((response) => {
            this.countries = response.data.data;
        });
    }

    submitFirstStep($event, form) {
        $event.preventDefault();

        if (!this.checkDateOfBirth(form.dateOfBirth)) {
            return false;
        }

        this.$timeout(() => {
            this.state.step = 2;
        }, 500);
    }

    submitSecondStep($event, form) {
        $event.preventDefault();

        if (!this.checkConfirmPassword(form.confirmPassword)) {
            return false;
        }

        this.sendRegisterForm();
    }

    checkConfirmPassword(field) {
        if (this.user.confirmPassword !== this.user.password) {
            field.$setValidity('doesNotMatch', false);
            return false
        }

        field.$setValidity('doesNotMatch', true);
        return true
    }

    checkDateOfBirth(field) {
        if (this.user.dateOfBirth) {
            let today = new Date(),
                userDateBirth = this.user.dateOfBirth;

            const dayDiff = today.getDate() - userDateBirth.getDate(),
                monthDiff = today.getMonth() - userDateBirth.getMonth(),
                yearDiff = today.getFullYear() - userDateBirth.getFullYear();

            if (yearDiff > 18 || (yearDiff === 18 && (monthDiff > 0 || (monthDiff === 0 && dayDiff >= 0)))) {
                field.$setValidity('ageLimit', true);
                return true;
            }
        }

        field.$setValidity('ageLimit', false);
        return false;
    }

    goBack() {
        let {step} = this.state;

        if (step > 1) {
            this.state.step--
        } else {
            this.$location.path('/');
        }
    }

    sendRegisterForm() {
        let user = {
            name: this.user.firstName + ' ' + this.user.lastName,
            birth_date: this.user.dateOfBirth,
            email: this.user.email,
            password: this.user.password,
            password_confirmation: this.user.confirmPassword,
            country_id: this.user.country_id,
            sms_subscribe: 1,
            email_subscribe: 1
        };

        this.RegistrationService.createUser(user)
            .then((response) => {
                if (response.status === 200) {
                    this.state.status = 'link';
                } else {
                    console.log(response);
                }
            });

    }
}

RegisterController.$inject = ['$timeout','$location', 'RegistrationService', 'CountriesResourceService'];

export {RegisterController};
