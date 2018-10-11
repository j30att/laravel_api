import {MainMenuComponent} from "./Components/main-menu/main-menu.controller";
import {SaleCreateComponent} from "./Components/sale-create/sale-create.controller";
import {SaleManageComponent} from "./Components/sale-manage/sale-manage.controller";
import {BidPlaceComponent} from "./Components/bid-place/bid-place.controller"

let angular = require('angular');

let module = angular.module('Components', []);

module.component('mainMenu', MainMenuComponent);
module.component('saleCreate', SaleCreateComponent);
module.component('saleManage', SaleManageComponent);
module.component('bidPlace', BidPlaceComponent);

export default module.name;

