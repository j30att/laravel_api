class SaleModal {
    constructor() {
    }


    $onInit() {
    }

    close(){
        this.show = !this.show;
    }
}

SaleModal.$inject = ['$scope'];

export const SaleModalComponent = {
    bindings: {
        sale: '<',
        show: '=',
    },
    template: require('./sale-modal.template.html'),
    controller: SaleModal,
    controllerAs: '$ctrl'
};
