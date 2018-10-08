class MainController {
    constructor($state) {
        this.$state = $state;
        console.log(this.$state);
    };

};

MainController.$inject = ['$state'];
export {MainController};