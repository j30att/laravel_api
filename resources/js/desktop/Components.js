import {ProfileComponent} from "./Components/profile/profile.controller";
import {MainMenuComponent} from "./Components/main-menu/main-menu.controller";
import {SaleCreateComponent} from "./Components/sale-create/sale-create.controller";
import {SaleManageComponent} from "./Components/sale-manage/sale-manage.controller";
import {BidPlaceComponent} from "./Components/bid-place/bid-place.controller";
import {LoginComponent} from "./Components/login/login.controller";
import {RegistrationComponent} from "./Components/registration/registration.controller";
import {InputMarkupComponent} from "../common/components/input/input-markup/input-markup.controller";
import {InputAmountComponent} from "../common/components/input/input-amount/input-amount.controller";
import {InputShareComponent} from "../common/components/input/input-share/input-share.controller";
import {SaleDetailsComponent} from "./Components/sale_details/sale_details.controller";
import {UserDetailsComponent} from "./Components/user_details/user_details.controller";
import {LogDetailsComponent} from "./Components/log_details/log_details.controller";
import {StubComponent} from "./Components/stub/stub.controller";

let angular = require('angular');

let module = angular.module('Components', []);

module.component('profile', ProfileComponent);
module.component('mainMenu', MainMenuComponent);
module.component('saleCreate', SaleCreateComponent);
module.component('saleManage', SaleManageComponent);
module.component('bidPlace', BidPlaceComponent);
module.component('login', LoginComponent);
module.component('registration', RegistrationComponent);
module.component('inputMarkup', InputMarkupComponent);
module.component('inputAmount', InputAmountComponent);
module.component('inputShare', InputShareComponent);
module.component('saleDetails', SaleDetailsComponent);
module.component('userDetails', UserDetailsComponent);
module.component('logDetails', LogDetailsComponent);
module.component('stub', StubComponent);

export default module.name;

