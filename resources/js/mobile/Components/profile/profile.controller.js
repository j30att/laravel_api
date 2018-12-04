
class Profile {
    constructor($scope, $mdSidenav, $state, $http, Upload, CountriesResourceService, $timeout) {
        this.$mdSidenav = $mdSidenav;
        this.CountriesResourceService = CountriesResourceService;
        this.$scope = $scope;
        this.$state = $state;
        this.$timeout =$timeout;
        this.user = window.__user;
        this.isSidenavOpen = false;
        this.Upload = Upload;
        this._opts = {};
        this.state = 'edit_profile';


        this.splitUserName();
        this.getCountries();
        this.parseUserBirth();
        this.pareseData =  this.parseUserBirth();
        this.editEmail = this.user.email;

    }

    $onInit() {
        this.$scope.$on('sidenav-profile_mobile-open', (event, data) => {
            this.buildToggler('profile_mobile');
        });

        this.$scope.$watch('sidenav-profile_mobile-open', (fixed) => {
            this.$state.modalOpened = fixed;
        });

    };



    buildToggler(componentId) {
        this.$mdSidenav(componentId).toggle();
    }


    getCountries() {
        this.CountriesResourceService.getCountries()
            .then((response) => {
                this.countries = response.data.data;
                this.userContry = this.countries[(this.user.country_id - 1)];
                this.editCountry = this.userContry.name;
            });
    }
    splitUserName(){
        let userNameString = this.user.name;
        let nameArr = userNameString.split(' ', 2);

        this.userFistName = nameArr[0];
        this.userLastName = nameArr[1];

        this.editFistName = this.userFistName;
        this.editLastName = this.userLastName;

    }

    changeType(event){
        let selectInput = document.querySelector('#edit_birth');
        console.log(this.editBirth);
        console.log('inside change input');
        event.target.type = 'date';
        // selectInput.onfocus = () => {
        //         event.target.type = 'date';
        //         this.user_birth_date = this.user.birth_date;
        // };


        selectInput.onblur = () => {
            event.target.type = 'text';
            if(this.editBirth != undefined){
                this.user.birth_date = this.editBirth;
                this.editBirth = undefined;
                this.parseUserBirth();
                this.pareseData = this.parseUserBirth();
                return this.pareseData;
            }

        };
        return this.pareseData;
    };



    parseUserBirth(){
        let birth = this.user.birth_date;
        let birthArr = birth.split('-', 3);
        let year = birthArr[0];
        let month = birthArr[1];
        let dayNotParse = birthArr[2];

        let day = dayNotParse.split(' ', 2)[0];

        switch (month) {
            case '01':
                month = 'Jan';
                break;
            case '02':
                month = 'Feb';
                break;
            case '03':
                month = 'Mar';
                break;
            case '04':
                month = 'Apr';
                break;
            case '05':
                month = 'May';
                break;
            case '06':
                month = 'June';
                break;
            case '07':
                month = 'July';
                break;
            case '08':
                month = 'Aug';
                break;
            case '09':
                month = 'Sept';
                break;
            case '10':
                month = 'Oct';
                break;
            case '11':
                month = 'Nov';
                break;
            case '12':
                month = 'Dec';
                break;
        }

        let parsedDate = month + ' ' + day + ', ' + year;

        return parsedDate;
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

        let newUserData = {
            name: this.editFistName + ' ' + this.editLastName,
            birth : this.editBirth,
            country_id : this.userContry.id,
            email: this.editEmail
        };
        console.log(newUserData);
    }



};

Profile.$inject = ['$scope', '$mdSidenav', '$state', '$http', 'Upload', 'CountriesResourceService', '$timeout'];

export const ProfileComponent = {

    template: require('./profile.template.html'),
    controller: Profile,
    controllerAs: '$ctrl'
};
