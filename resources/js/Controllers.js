let angular = require('angular');

import {LoginController} from "./Controllers/LoginController";
import {RegisterController} from "./Controllers/RegisterController";
import {ProfileController} from "./Controllers/ProfileController";

let module = angular.module('Controllers', []);

module.controller('LoginController', LoginController);
module.controller('RegisterController', RegisterController);
module.controller('ProfileController', ProfileController);
    
export default module.name;
