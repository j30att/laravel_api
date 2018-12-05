class DealerUsersController{
    constructor(DealerResourceService,$scope){
        this.DealerResourceService = DealerResourceService;
        this.getUsers();
        this.$scope = $scope;
        this._opts = {
            dataLoad:false
        }
    }


    getUsers(){
        this.DealerResourceService.getUsers().then(response => {
            console.log(response);
            this.users = response.data.data;
            this._opts.dataLoad = true;
        });
    }

    toggleSidenav(){
        this.$scope.$broadcast('sidenav-saleDetails-open', () =>{
        });
    }

}

DealerUsersController.$inject = ['DealerResourceService', '$scope'];

export {DealerUsersController};
