class MainMenuController {
    constructor($state, $scope) {
        this.$scope = $scope;
        this.url = $state.current.url;
        console.log('main menu');
    }


    toggleSidenav() {
        console.log('main menu 11111111111');
        this.$scope.$broadcast('sidenav-profile-open', () =>{
            console.log('open sidenav')
        });
    }

    isActive(string) {
        if (this.url.indexOf(string) === 1) {
            return {active: true}
        }
        return null
    }

}

MainMenuController.$inject = ['$state', '$scope'];

export const MainMenuComponent = {
    bindings: {
        state: '<',
    },
    template: require('./main-menu.template.html'),
    controller: MainMenuController,
    controllerAs: '$ctrl'
};
