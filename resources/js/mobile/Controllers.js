let angular = require('angular');

import {LoginController} from "./Controllers/LoginController";
import {RegisterController} from "./Controllers/RegisterController";
import {ProfileController} from "./Controllers/ProfileController";


////////////////////////////////////////////////////////
import {BidsController} from "./Controllers/BidsController";
import {BidsFilterController} from "./Controllers/BidsFilterController";
import {SaleController} from "./Controllers/SaleController"
import {SaleAllController} from "./Controllers/SaleAllController"
import {SaleFilterController} from "./Controllers/SaleFilterController";
import {SaleManageController} from "./Controllers/SaleManageController"
import {SaleFormController} from "./Controllers/SaleFormController"
import {InvestController} from "./Controllers/InvestController";
import {EventController} from "./Controllers/EventController";
import {EventsListController} from "./Controllers/EventsListController";
import {MenuController} from "./Controllers/MenuController";
import {EventInfoController} from "./Controllers/EventInfoController";
import {MainController} from "./Controllers/MainController";

let module = angular.module('Controllers', []);

module.controller('LoginController', LoginController);
module.controller('RegisterController', RegisterController);
module.controller('ProfileController', ProfileController);
module.controller('EventsListController', EventsListController);


/////////////////////////////////////////////////////////////

module.controller('SaleController', SaleController);
module.controller('SaleFilterController', SaleFilterController);
module.controller('SaleAllController', SaleAllController);
module.controller('SaleFormController', SaleFormController);
module.controller('SaleManageController', SaleManageController);

module.controller('InvestController', InvestController);
module.controller('EventController', EventController);
module.controller('EventsListController', EventsListController);
module.controller('BidsController', BidsController);
module.controller('BidsFilterController', BidsFilterController);
module.controller('MenuController', MenuController);
module.controller('EventInfoController', EventInfoController);
module.controller('MainController', MainController);


export default module.name;










