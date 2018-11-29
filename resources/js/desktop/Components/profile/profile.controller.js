class Profile {
    constructor($scope, SalesResourceService, $mdSidenav, $http, SalesService, $timeout, $state, Upload) {
        this.SalesResourceService = SalesResourceService;
        this.SalesService = SalesService;
        this.$mdSidenav = $mdSidenav;
        this.$timeout = $timeout;
        this.$state = $state;
        this.$scope = $scope;
        this.$http = $http;
        this.user = window.__user;
        this._opts = {fixed: false};
        this.isSidenavOpen = false;
        this.Upload = Upload;
        this._opts = {}
        this.linkUrl = window.__linkUrl;
    }

    $onInit() {
        this.$scope.$on('sidenav-profile-open', (event, data) => {
            this.buildToggler('right_profile');
        });

        this.$scope.$watch('isSidenavOpen', (fixed) => {
            this.$state.modalOpened = fixed
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

Profile.$inject = ['$scope', 'SalesResourceService', '$mdSidenav', '$http', 'SalesService', '$timeout', '$state', 'Upload'];

export const ProfileComponent = {
    bindings: {},
    template: require('./profile.template.html'),
    controller: Profile,
    controllerAs: '$ctrl'
};
