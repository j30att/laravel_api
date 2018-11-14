class DealerWinController{
    constructor($scope, CurrencyResourceService, $mdDialog){
        this.CurrencyResourceService = CurrencyResourceService;
        this.$scope = $scope;
        this.placed = null;
        this.$mdDialog = $mdDialog;
        this.currency = null;
        this.placedArr();
        this.getCurrency();
        this.result = {
            placed: null,
            amount: null,
            currency_id: null,
        }
        this._opts = {validate: true};
    }


    placedArr(){
        this.placeArr = [];
        for (let i = 1; i < 21; i++) {
            this.placeArr.push(i);
        }
    }

    confirmSale(){
        if(this.validate()){
        this.$mdDialog.hide(this.result);
        }
    }
    closeModal(){
        this.$mdDialog.cancel();
    }

    getCurrency(){
        this.CurrencyResourceService.getCurrency().then((responce) => {
            this.currencyArr = responce.data;
        })
    };

    validate(){
        if(this.result.placed != null && this.result.amount != null && this.result.currency_id != null){
            this._opts.validate = true;
            return true;
        } else {
            this._opts.validate = false;
            return false;
        }
    }




}

DealerWinController.$inject = ['$scope', 'CurrencyResourceService', '$mdDialog'];

export {DealerWinController};
