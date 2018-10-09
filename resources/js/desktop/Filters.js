import {ucFirst} from "../common/filters/uc-first";

let module = angular.module('Filters', []);
module.filter('ucFirst', ucFirst);

export default module.name;
