class InputMarkupController {
    onChange() {
        let {bid, buyIn} = this;
        console.log(buyIn);
        if (bid.markup) {
            bid.markup = bid.markup.replace(/,|\.+/, '.').replace(/[^0-9.]/, '');
            buyIn = parseFloat(buyIn);
            console.log(buyIn);
            if (bid.share) {
                bid.amount = (bid.share / 100) * bid.markup * buyIn;
            } else if (bid.amount) {
                bid.share = bid.amount / (buyIn * bid.markup * 100);
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