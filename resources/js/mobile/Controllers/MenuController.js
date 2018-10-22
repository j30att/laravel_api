class MenuController {
    constructor($state) {
        this.$state = $state;
        this.menuItem = this.$state.current.menu;

    };

};

MenuController.$inject = ['$state'];

export {MenuController};