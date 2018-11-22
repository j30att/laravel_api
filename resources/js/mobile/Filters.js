import {optionFilter} from "../common/filters/option-filter";

let module = angular.module('Filters', []);

module.filter('optionFilter', optionFilter);

export default module.name;
