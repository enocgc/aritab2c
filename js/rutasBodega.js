appRouterArita.config(function($routeProvider){

	$routeProvider
	.when('/listproduct',{
		templateUrl  :  './listproduct.html',
		controller : 'listproduct'
	})

	.otherwise({
		templateUrl : './desktop.html',
		controller : 'arita'
	});


});
