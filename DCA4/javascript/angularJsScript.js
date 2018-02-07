//Create arrivals module
var arrivalsModule = angular.module('arrivalsModule', []);
//Associate the module with the controller               
arrivalsModule.controller("arrivalsController", function($scope, $http) {
        $http.post('./classes/arrivals.php')
             .then(function(response){
                $scope.arrivalsArray = response.data;
             });
         
        });
//Create enroutes module
var enroutesModule = angular.module('enroutesModule', []);
//Associate the module with controller
enroutesModule.controller("enroutesController", function($scope, $http) {
        $http.post('./classes/enroutes.php')
             .then(function(response){
                $scope.enroutesArray = response.data;
                $scope.statuscode = response.status;
                $scope.statustext = response.statustext; 
             });
                  
       });  

 
// Add additional modules manually becuse Angular can bootstrap only one app automatically
angular.bootstrap(document.getElementById("enroutesDiv"), ['enroutesModule']);
   
 

