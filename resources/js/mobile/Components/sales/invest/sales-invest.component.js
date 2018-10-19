import {Sales} from '../sales.controller'

export const SalesInvestComponent = {
    bindings: {
        subevent: '<',
        sales:    '<',
        state:     '<',
    },
    template: require('./sales-invest.template.html'),
    controller: Sales,
    controllerAs: '$ctrl'
};