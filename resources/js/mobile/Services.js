let angular = require('angular');

import {BidsResourceService} from "../common/api/BidsResourceService";
import {SalesResourceService} from "../common/api/SalesResourceService";

let module = angular.module('Services', []);

module.service('BidsResourceService', BidsResourceService);
module.service('SalesResourceService', SalesResourceService);


export default module.name;