import {ucFirst} from "../common/filters/uc-first";
import {percent} from "../common/filters/percentage";

let module = angular.module('Filters', []);
module.filter('ucFirst', ucFirst);
module.filter('percent', percent);

export default module.name;
