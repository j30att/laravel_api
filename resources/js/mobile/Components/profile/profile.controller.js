
class Profile {
    constructor($scope, $mdSidenav, $state, $http, Upload, CountriesResourceService) {
        this.$mdSidenav = $mdSidenav;
        this.CountriesResourceService = CountriesResourceService;
        this.$scope = $scope;
        this.$state = $state;
        this.user = window.__user;
        this.isSidenavOpen = false;
        this.Upload = Upload;
        this._opts = {};
        this.state = 'edit_profile';

        this.splitUserName();
        this.getCountries();
    }

    splitUserName(){
        let userNameString = this.user.name;
        let nameArr = userNameString.split(' ', 2);

        this.userFistName = nameArr[0];
        this.userLastName = nameArr[1];
    }

    getCountries() {
        this.CountriesResourceService.getCountries()
            .then((response) => {
                this.countries = response.data.data;
                this.userContry = this.countries[(this.user.country_id - 1)];
            });
    }


    $onInit() {
        this.$scope.$on('sidenav-profile_mobile-open', (event, data) => {
            this.buildToggler('profile_mobile');
        });

        this.$scope.$watch('sidenav-profile_mobile-open', (fixed) => {
            this.$state.modalOpened = fixed;
        });

    }

    buildToggler(componentId) {
        this.$mdSidenav(componentId).toggle();
    }


    close(componentId) {
        this.$mdSidenav(componentId).close();
    }

    uploadAvatar() {
        if (!this.uploadedAvatar) return false;
        if (this._opts.avatar_loading) return false;

        this._opts.avatar_loading = true;
        this._opts.avatar_error = false;
        this._opts.avatar_msg = '';


        this.Upload.upload({
            url: '/profile/avatar',
            data: {avatar: this.uploadedAvatar}
        })
            .then((res) => {
                if (res.data.status == 0) {
                    this._opts.avatar_error = true;
                    this._opts.avatar_msg = res.data.msg;
                    this._opts.avatar_loading = false;
                    this.$timeout(() => {
                        this._opts.avatar_error = false;
                    }, 2000);
                }
                if (res.data.status == 1) {
                    this.user.profile_avatar_url = res.data.avatar;
                    this._opts.avatar_loading = false;
                    this.user.avatar = res.data.avatar;
                }
            })
            .catch((e) => {
                console.log(e);
                this._opts.avatar_error = true;
                this._opts.avatar_msg = 'Ошибка при загрузке аватара';
                this._opts.avatar_loading = false;

                this.$timeout(() => {
                    this._opts.avatar_error = false;
                }, 2000);
            })
    }

    saveNewUserData(){

    }



};

Profile.$inject = ['$scope', '$mdSidenav', '$state', '$http', 'Upload', 'CountriesResourceService'];

export const ProfileComponent = {

    template: require('./profile.template.html'),
    controller: Profile,
    controllerAs: '$ctrl'
};
