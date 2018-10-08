class Sales {
    constructor($state) {
        this.$state = $state;
        this.showPlace = false;
        this.showManage = false
        this.item = null;
    }


    $onInit() {
    }

    showModal(key, type){
        console.log('hui');

        if(type == 'manage')  this.showManage = true;
        if(type == 'place')   this.showPlace = true;
        this.$state.modalOpened = true;
        this.item = this.sales[key];
    }
}

Sales.$inject = ['$state'];


export const SalesComponent = {
    bindings: {
        subevent: '<',
        sales:    '<',
        state:     '<',
    },
    template: require('./sales.template.html'),
    controller: Sales,
    controllerAs: '$ctrl'
};
