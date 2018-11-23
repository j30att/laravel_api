class InputShareController {
    onChange() {
        let {bid, buyIn} = this;
        if (bid.share) {
            bid.share = bid.share.replace(/,|\.+/, '.').replace(/[^0-9.]/, '');
            buyIn = parseFloat(buyIn);

            if (bid.markup) {
                bid.amount = Math.round(((bid.share / 100) * bid.markup * buyIn) * 100) / 100;
            } else if (bid.amount) {
                bid.markup = Math.round((((bid.share / 100) * buyIn) / bid.amount) * 100) / 100;
            }
            /*bid.share += '%';*/
        }
    }
}

export const InputShareComponent = {
    bindings: {
        bid: '=',
        buyIn: '<',
        type: '@',
        className: '@',
        placeholder: '@'
    },
    template: require('./input-share.template.html'),
    controller: InputShareController,
    controllerAs: 'InputCtrl'
};
