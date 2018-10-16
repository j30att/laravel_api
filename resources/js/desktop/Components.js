import {ProfileComponent} from "./Components/profile/profile.controller";
import {MainMenuComponent} from "./Components/main-menu/main-menu.controller";
import {SaleCreateComponent} from "./Components/sale-create/sale-create.controller";
import {SaleManageComponent} from "./Components/sale-manage/sale-manage.controller";
import {BidPlaceComponent} from "./Components/bid-place/bid-place.controller";
import {LoginComponent} from "./Components/login/login.controller";
import {RegistrationComponent} from "./Components/registration/registration.controller";

let angular = require('angular');

let module = angular.module('Components', []);

module.component('profile', ProfileComponent);
module.component('mainMenu', MainMenuComponent);
module.component('saleCreate', SaleCreateComponent);
module.component('saleManage', SaleManageComponent);
module.component('bidPlace', BidPlaceComponent);
module.component('login', LoginComponent);
module.component('registration', RegistrationComponent);

export default module.name;

