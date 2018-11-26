export const  StubComponent = {
    bindings: {
        title: '@',
        description: '@',
        image: '@'
    },
    transclude: true,
    template: require('./stub.template.html'),
    controllerAs: '$ctrl'
};
