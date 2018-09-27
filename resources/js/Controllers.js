let angular = require('angular');

import {LoginController} from "./Controllers/LoginController";
import {RegisterController} from "./Controllers/RegisterController";
import {ProfileController} from "./Controllers/ProfileController";
import {EventsListController} from "./Controllers/EventsListController";
import {FilterBidsController} from "./Controllers/FilterBidsController";
import {BidResponsesController} from "./Controllers/BidResponsesController";
import {FilterBidResponsesController} from "./Controllers/FilterBidResponsesController";

let module = angular.module('Controllers', []);

module.controller('LoginController', LoginController);
module.controller('RegisterController', RegisterController);
module.controller('ProfileController', ProfileController);
module.controller('EventsListController', EventsListController);
module.controller('FilterBidsController', FilterBidsController);
module.controller('BidResponsesController', BidResponsesController);
module.controller('FilterBidResponsesController', FilterBidResponsesController);

export default module.name;










