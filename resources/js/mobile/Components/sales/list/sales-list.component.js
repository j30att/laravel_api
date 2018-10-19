import {Sales} from '../sales.controller'

export const SalesListComponent = {
    bindings: {
        subevent: '<',
        sales:    '<',
        state:     '<',
    },
    template: require('./sales-list.template.html'),
    controller: Sales,
    controllerAs: '$ctrl'
};