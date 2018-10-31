let angular = require('angular');

import {LoginController} from "./Controllers/LoginController";
import {RegisterController} from "./Controllers/RegisterController";
import {ProfileController} from "./Controllers/ProfileController";
import {FilterBidsController} from "./Controllers/FilterBidsController";

import {MainController} from "./Controllers/MainController";
import {BidsController} from "./Controllers/bids/BidsController";
import {InvestController} from "./Controllers/invest/InvestController";
import {SaleFormController} from "./Controllers/SaleFormController"

import {EventController} from "./Controllers/EventController";
import {EventsController} from "./Controllers/events/EventsController";
import {DialogController} from "./Controllers/DialogController"

import {SaleController} from "./Controllers/sales/SaleController";
import {SaleInvestController} from "./Controllers/sales/SaleInvestController";
import {SaleFilterController} from "./Controllers/sales/SaleFilterController";
import {EventsDetailController} from "./Controllers/events/EventsDetailController";

import {PopupController} from "./Controllers/PopupController"

import {DealerEventsController} from "./Controllers/dealer/DealerEventsController";
import {DealerEventDetailController} from "./Controllers/dealer/DealerEventDetailController";
import {DealerUsersController} from "./Controllers/dealer/DealerUsersController";


let module = angular.module('Controllers', []);

module.controller('LoginController', LoginController);
module.controller('RegisterController', RegisterController);
module.controller('MainController', MainController);
module.controller('ProfileController', ProfileController);
module.controller('EventsController', EventsController);
module.controller('FilterBidsController', FilterBidsController);
module.controller('BidsController', BidsController);
module.controller('SaleFormController', SaleFormController);
module.controller('SaleFilterController', SaleFilterController);
module.controller('InvestController', InvestController);
module.controller('EventController', EventController);
module.controller('DialogController', DialogController);


/////////////////////////////////////////////////////////////

module.controller('SaleController', SaleController);
module.controller('PopupController', PopupController);
module.controller('SaleInvestController', SaleInvestController);
module.controller('EventsDetailController', EventsDetailController);

module.controller('DealerEventsController', DealerEventsController);
module.controller('DealerEventDetailController',DealerEventDetailController);
module.controller('DealerUsersController', DealerUsersController);


export default module.name;










