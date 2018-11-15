middlewares.$inject = ['PermRoleStore'];

export default function middlewares(PermRoleStore) {
    PermRoleStore.defineRole('Auth', function(){
        return window.__user !== null;
    });

    PermRoleStore.defineRole('Guest', function(){
        return window.__user === null;
    });

    PermRoleStore.defineRole('Admin', function () {
       return (window.__user !== null && window.__user.role == 2)
    });
}