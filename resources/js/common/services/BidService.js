class BidsService {
    constructor() {

    };

    calcAmount(share, markup, buyin){
        let shareValue = null;
        let amount = null;

        shareValue = buyin * (share / 100);
        amount = shareValue * markup;

        return Math.round(amount*10)/10;
    }

    calcMarkup(share, amount, buyin){
        let markup = null;
        let shareValue = buyin * (share / 100);

        markup = amount / shareValue;

        return Math.round(markup);
    }

    calcShare(markup, amount, buyin){
        let share = null;

        share = amount / (buyin * markup);

        return Math.round(share*10);

    }



}

export {BidsService};
