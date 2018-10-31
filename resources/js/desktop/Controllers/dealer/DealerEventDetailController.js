
class DealerEventDetailController {
    constructor(DealerResourceService, $state){
        this.DealerResourceService = DealerResourceService;
        this.$state = $state;
        this.getEvent(this.$state.params.id);
    }

    getEvent(id){
        console.log(id, 'id');
        this.DealerResourceService.getEvent(id).then(response => {
            this.event = response.data.data;
        })
    }
}

DealerEventDetailController.$inject = ['DealerResourceService', '$state'];

export {DealerEventDetailController};