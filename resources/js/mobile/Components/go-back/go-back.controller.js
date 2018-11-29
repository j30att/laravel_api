class GoBackController {
    constructor($window) {
        this.$window = $window;
    }

    goBack(){
        this.$window.history.back()
    }
}

GoBackController.$inject = ['$window'];

export const GoBackComponent = {
    template: require('./go-back.template.html'),
    controller: GoBackController,
    controllerAs: '$ctrl'
};
