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

    calcMarkup(amount, buyin, share){
        let markup = null;

        markup = amount / (buyin*share);

        return Math.round(markup*10)/10;
    }

    calcShare(amount, buyin, markup){
        let share = null;

        share = amount / (buyin*markup);

        return Math.round(share*10)/10;
    }



}

export {BidsService};
