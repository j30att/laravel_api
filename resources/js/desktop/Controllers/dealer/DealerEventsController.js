class DealerEventsController{
    constructor(DealerResourceService){
        this.DealerResourceService = DealerResourceService;
        this.getEvents();
    }

    getEvents(){

        this.DealerResourceService.getEvents().then(response =>{
            this.events = response.data.data;
        })
    }

}

DealerEventsController.$inject = ['DealerResourceService'];

export {DealerEventsController};
