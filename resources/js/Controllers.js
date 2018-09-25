let angular = require('angular');

import {LoginController} from "./Controllers/LoginController";
import {RegisterController} from "./Controllers/RegisterController";
import {ProfileController} from "./Controllers/ProfileController";
import {EventsListController} from "./Controllers/EventsListController";

let module = angular.module('Controllers', []);

module.controller('LoginController', LoginController);
module.controller('RegisterController', RegisterController);
module.controller('ProfileController', ProfileController);
module.controller('EventsListController', EventsListController);
    
export default module.name;










