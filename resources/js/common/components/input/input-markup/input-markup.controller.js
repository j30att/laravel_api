class InputMarkupController {
    onChange() {
        let {bid, buyIn} = this;

        if (bid.markup) {
            bid.markup = bid.markup.replace(/,|\.+/, '.').replace(/[^0-9.]/, '');
            buyIn = parseFloat(buyIn);

            if (bid.share) {
                let share = parseFloat(bid.share);
                bid.amount = '$' + Math.round(((share / 100) * bid.markup * buyIn) * 100) / 100;
            } else if (bid.amount) {
                let amount = bid.amount.indexOf('$') > -1 ? bid.amount.replace('$', '') : bid.amount;
                bid.share = Math.round((amount / buyIn * bid.markup * 100) * 100) / 100 + '%';
            }
        }
    }
}

export const InputMarkupComponent = {
    bindings: {
        bid: '=',
        buyIn: '<',
        type: '@',
        className: '@',
        placeholder: '@'
    },
    template: require('./input-markup.template.html'),
    controller: InputMarkupController,
    controllerAs: 'InputCtrl'
};