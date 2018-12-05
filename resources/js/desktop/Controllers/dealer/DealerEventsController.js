class DealerEventsController{
    constructor(DealerResourceService){
        this.DealerResourceService = DealerResourceService;
        this.getEvents();
        this._opts = {
            dataLoad : false
        };
        console.log(this._opts.dataLoad)
    }

    getEvents(){

        this.DealerResourceService.getEvents().then(response =>{

            this.events = response.data.data;
            console.log(132);
            this._opts.dataLoad = true;
            console.log(this._opts.dataLoad);
        })
    }

}

DealerEventsController.$inject = ['DealerResourceService'];

export {DealerEventsController};
