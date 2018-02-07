//Create module
var myApp = angular.module("myModule", []);
//Create controller
var myController = function($scope, $http){
    //$scope.message = "AngularJS Tutorial";
    /*$http.get("http://www.imerkato.com/DCA3/classes/arrivals.php")
    .then(function (response) {$scope.names = response.data.records;});*/
    
$http.get('http://www.imerkato.com/DCA3/classes/arrivals.php').
        success(function(data) {
            // here the data from the api is assigned to a variable named users
            $scope.mydata = data;
        });
};
//register controller with module
myApp.controller("myController", myController);


