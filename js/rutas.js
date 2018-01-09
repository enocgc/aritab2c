appRouter.config(function($routeProvider) {
    $routeProvider
    .when("/listproduct", {
        templateUrl : "listproduct.html"
    })
    .when("/listuser", {
        templateUrl : "listusers.html"
    })
    .when("/contrieslist", {
        templateUrl : "listcountries.html"
    })
    .when("/locationlist", {
        templateUrl : "listlocations.html"
    })
		.when("/packageslist", {
        templateUrl : "listpackages.html"
    })
		.when("/seasonlist", {
        templateUrl : "listseason.html"
    })
		.when("/taglist", {
        templateUrl : "listtags.html"
    })
		.when("/listlanguage", {
        templateUrl : "listlanguages.html"
    }).when("/addcountry", {
        templateUrl : "addcountry.html"
    }).when("/addlocation", {
        templateUrl : "addlocation.html"
    })
		.when("/addproduct", {
        templateUrl : "addproduct.html"
    })
		.when("/addpackage", {
        templateUrl : "addpackage.html"
    })
		.when("/addlanguage", {
        templateUrl : "addlanguage.html"
    }).when("/adduser", {
        templateUrl : "adduser.html"
    }).when("/itineraries", {
        templateUrl : "listitineraries.html"
    })
		.when("/additineries", {
        templateUrl : "additinerary.html"
    }).when("/media", {
        templateUrl : "media.html"
    });
});
