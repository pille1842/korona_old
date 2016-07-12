var app = angular.module('koronaApp', ['ui.bootstrap'], function($interpolateProvider) {
    // Don't use {{ }} -- we need this for Blade templates
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});
