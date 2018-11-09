import {BID_MATCHED} from "../Constants";

class SalesService {
    constructor(){

    };

    calcAmount(share, markup, buyin){
        let shareValue = null;
        let amount = null;

        shareValue = buyin * (share / 100);
        amount = shareValue * markup;

        return Math.round(amount*10)/10;
    }

    calcAmountRaised(sale){
        if (sale != null){
            let amountRaised = 0;
            sale.bids.forEach(function (value, key) {
                if (value.status == BID_MATCHED){
                    amountRaised += value.amount
                }
            });
            let amountRaisedText = amountRaised + ' $';
            return amountRaisedText;
        }
    };

    calcShareSold(sale){
        if (sale != null) {
            let amountRaised = parseInt(this.calcAmountRaised(sale).slice(0, -2));
            let buyIn = sale.event.buy_in;

            let share = Math.round(amountRaised / buyIn);

            let shareText = share + ' %';

            return shareText;
        }

    }



}

export {SalesService};
