class DealerUsersController{
    constructor(DealerResourceService,$scope){
        this.DealerResourceService = DealerResourceService;
        this.getUsers();
        this.$scope = $scope;
    }


    getUsers(){
        this.DealerResourceService.getUsers().then(response => {
            console.log(response);
            this.users = response.data.data;
        });
    }

    toggleSidenav(){
        this.$scope.$broadcast('sidenav-saleDetails-open', () =>{
        });
    }

}

DealerUsersController.$inject = ['DealerResourceService', '$scope'];

export {DealerUsersController};
