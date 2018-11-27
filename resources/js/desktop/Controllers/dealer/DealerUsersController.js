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
            // if(this.users.avatar == null){
            //     this.users.avatar = '/images/avatar_placeholder.png';
            //     return this.users.avatar;
            // }

        });
    }

    toggleSidenav(){
        this.$scope.$broadcast('sidenav-saleDetails-open', () =>{
        });
    }

}

DealerUsersController.$inject = ['DealerResourceService', '$scope'];

export {DealerUsersController};
