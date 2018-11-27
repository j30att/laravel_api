
class Profile {
    constructor($scope, $mdSidenav, $state, $http, Upload) {
        this.$mdSidenav = $mdSidenav;
        this.$scope = $scope;
        this.$state = $state;
        this.user = window.__user;
        this.isSidenavOpen = false;
        this.Upload = Upload;
        this._opts = {};
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



};

Profile.$inject = ['$scope', '$mdSidenav', '$state', '$http', 'Upload'];

export const ProfileComponent = {

    template: require('./profile.template.html'),
    controller: Profile,
    controllerAs: '$ctrl'
};
