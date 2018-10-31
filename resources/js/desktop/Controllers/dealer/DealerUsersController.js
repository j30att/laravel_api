class DealerUsersController{
    constructor(DealerResourceService){
        this.DealerResourceService = DealerResourceService;
        this.getUsers();
    }


    getUsers(){
        this.DealerResourceService.getUsers().then(response => {
            console.log(response);
            this.users = response.data.data;
        });
    }

}

DealerUsersController.$inject = ['DealerResourceService'];

export {DealerUsersController};
