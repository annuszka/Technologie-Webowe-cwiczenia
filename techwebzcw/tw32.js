// AngularJS
var app = angular.module("ajsImiona", []);
app.controller("ctlImiona", function($scope, $http) {
	$scope.order = 'pozycja'; //przypisac domyslne sortowanie
	$scope.dir = false;
   //$scope.imiona = [ {pozycja: 1, imie: 'Ewa'}, {pozycja: 2, imie: 'Adam'} ]; PARAMETR SCOPE musi byc, http opcjonalny
   $http.get("service.php?imie=").then( function(response) {
     $scope.imiona = response.data;
   });
});
