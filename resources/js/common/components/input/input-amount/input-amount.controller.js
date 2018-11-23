class InputAmountController {
    onChange() {
        let {bid, buyIn} = this;

        if (bid.amount && bid.amount !== '$') {
            bid.amount = bid.amount.replace(/,|\.+/, '.').replace(/[^0-9.]/, '');
            buyIn = parseFloat(buyIn);

            if (bid.share && !bid.markup) {
                let share = parseFloat(bid.share);
                bid.markup = Math.round((((share / 100) * buyIn) / bid.amount) * 100) / 100;
            } else if (bid.markup) {
                bid.share = (Math.round((bid.amount / buyIn * bid.markup * 100) * 100) / 100) + '%';
            }
            bid.amount = '$' + bid.amount;
        } else if (bid.amount === '$') {
            bid.amount = '';
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
