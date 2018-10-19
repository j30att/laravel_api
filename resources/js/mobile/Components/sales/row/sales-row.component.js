import {Sales} from '../sales.controller'

export const SalesRowComponent = {
    bindings: {
        subevent: '<',
        sales:    '<',
        state:     '<',
    },
    template: require('./sales-row.template.html'),
    controller: Sales,
    controllerAs: '$ctrl'
};