import {MainMenuComponent} from "./Components/main-menu/main-menu.controller";
import {SaleCreateComponent} from "./Components/sale-create/sale-create.controller";
import {BidPlaceComponent} from "./Components/bid-place/bid-place.controller"

let angular = require('angular');

let module = angular.module('Components', []);

module.component('mainMenu', MainMenuComponent);
module.component('saleCreate', SaleCreateComponent);
module.component('bidPlace', BidPlaceComponent);

export default module.name;

