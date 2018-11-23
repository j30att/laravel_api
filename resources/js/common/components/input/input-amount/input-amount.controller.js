class InputAmountController {
    onChange() {
        let {bid, buyIn} = this;

        if (bid.amount) {
            bid.amount = bid.amount.replace(/,|\.+/, '.').replace(/[^0-9.]/, '');
            buyIn = parseFloat(buyIn);

            if (bid.share && !bid.markup) {
                bid.markup = Math.round((((bid.share / 100) * buyIn) / bid.amount) * 100) / 100;
            } else if (bid.markup) {
                bid.share = Math.round((bid.amount / buyIn * bid.markup * 100) * 100) / 100;
            }
        }
    }
}

export const InputAmountComponent = {
    bindings: {
        bid: '=',
        buyIn: '<',
        type: '@',
        className: '@',
        placeholder: '@'
    },
    template: require('./input-amount.template.html'),
    controller: InputAmountController,
    controllerAs: 'InputCtrl'
};
