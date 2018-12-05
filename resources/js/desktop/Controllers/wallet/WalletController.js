class WalletController {
    constructor(TransactionsResourceService) {
        this.TransactionsResourceService = TransactionsResourceService;

        this.ready = false;
        this.transactions = [];
        this.dates = [];
    }

    $onInit() {
        this.getTransactions();
    }

    getTransactions(filter) {
        this.TransactionsResourceService.getTransactions(filter)
            .then(response => {
                this.transactions = response.data.data;
                this.transactions.map(transaction => {
                    if (this.dates.indexOf(transaction.date) < 0) {
                        this.dates.push(transaction.date);
                    }
                });
                this.ready = true;
            });
    }

    setFilter(filter) {
        this.filter = filter;
        this.dates = [];
        this.getTransactions(filter);
    }
}

WalletController.$inject = ['TransactionsResourceService'];

export {WalletController}