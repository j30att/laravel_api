class MainController {
    constructor($state, $scope) {
        this.$state = $state;
        this.$scope = $scope;
    };

    toggleMobileProfile(){
        console.log('click/work');
        this.$scope.$broadcast('sidenav-profile_mobile-open', () => {
        });
    }

};

MainController.$inject = ['$state', '$scope'];
export {MainController};
