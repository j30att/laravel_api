let angular = require('angular');

import {LoginController} from "./Controllers/LoginController";
import {RegisterController} from "./Controllers/RegisterController";
import {ProfileController} from "./Controllers/ProfileController";
import {FilterBidsController} from "./Controllers/FilterBidsController";


////////////////////////////////////////////////////////
import {BidsController} from "./Controllers/BidsController";
import {SaleController} from "./Controllers/SaleController"
import {SaleAllController} from "./Controllers/SaleAllController"
import {SaleFormController} from "./Controllers/SaleFormController"
import {InvestController} from "./Controllers/InvestController";
import {EventController} from "./Controllers/EventController";
import {EventsListController} from "./Controllers/EventsListController";



let module = angular.module('Controllers', []);

module.controller('LoginController', LoginController);
module.controller('RegisterController', RegisterController);
module.controller('ProfileController', ProfileController);
module.controller('EventsListController', EventsListController);
module.controller('FilterBidsController', FilterBidsController);



/////////////////////////////////////////////////////////////
module.controller('SaleController', SaleController);
module.controller('SaleAllController', SaleAllController);
module.controller('SaleFormController', SaleFormController);
module.controller('InvestController', InvestController);
module.controller('EventController', EventController);
module.controller('EventsListController', EventsListController);
module.controller('BidsController', BidsController);


export default module.name;










