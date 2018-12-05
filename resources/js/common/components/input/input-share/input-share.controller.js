class InputShareController {
    onChange() {
        let {bid, buyIn} = this;
        if (bid.share) {
            buyIn = parseFloat(buyIn);
            bid.share = parseFloat(bid.share.replace(/,|\.+/, '.').replace(/[^0-9.]/, ''));

            if (bid.share > 100) {
                bid.share = 100;
            }

            if (bid.markup) {
                bid.amount = '$' + Math.round(((bid.share / 100) * bid.markup * buyIn) * 100) / 100;
                bid.errorAmount = false;
            } else if (bid.amount) {
                let amount = bid.amount.indexOf('$') > -1 ? bid.amount.replace('$', '') : bid.amount;
                bid.markup = Math.round((((bid.share / 100) * buyIn) / amount) * 100) / 100;
                bid.markupAmount = false;
            }

            bid.share += '%';
            bid.errorShare = false;
        }
    }

    onKeyDown($event) {
        let {keyCode, key, target} = $event;
        let {bid} = this;

        if (!this.isNumber(key)) {
            $event.preventDefault();

            if (this.isAllowCode(keyCode)) {
                if (keyCode === 8) {
                    bid.share = target.value.slice(0, -1);
                    return false;
                }
            }
        }
    }

    isNumber(key) {
        return (0 <= key) && (key <= 9);
    }

    isAllowCode(keyCode) {
        const allowCodes = [188, 190, 53, 8, 46];
        return allowCodes.indexOf(keyCode) > -1;
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
