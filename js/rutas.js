appRouter.config(function ($routeProvider) {
    $routeProvider
    .when("/listproduct", {
        templateUrl : "listproduct.html",
         controller  : 'controlProduct'
    })
    .when("/listuser", {
        templateUrl : "listusers.html",
         controller  : 'controlUser'
    })
    .when("/contrieslist", {
        templateUrl : "listcountries.html",
         controller  : 'controlCountries'
    }).when("/editcountry/:id", {
        templateUrl : "editcountry.html",
        controller  : 'controlCountries'
    })
    .when("/locationlist", {
        templateUrl : "listlocations.html",
         controller  : 'controlLocations'
    })
		.when("/packageslist", {
        templateUrl : "listpackages.html",
         controller  : 'controlPackage'
    })
		.when("/seasonlist", {
        templateUrl : "listseason.html",
        controller  : 'controlSeason'
    })
		.when("/taglist", {
        templateUrl : "listtags.html",
        controller  : 'controlTags'
    })
		.when("/listlanguage", {
        templateUrl : "listlanguages.html",
        controller  : 'controlLanguage'
    }).when("/addcountry", {
        templateUrl : "addcountry.html",
         controller  : 'controlCountries'
    }).when("/addlocation", {
        templateUrl : "addlocation.html",
         controller  : 'controlLocations'
    })
    .when("/editlocation/:id", {
        templateUrl : "editlocation.html",
         controller  : 'controlLocations'
    })
		.when("/addproduct", {
        templateUrl : "addproduct.html",
           controller  : 'controlProduct'
    })
    .when("/editproduct/:id", {
        templateUrl : "editproduct.html",
           controller  : 'controlProduct'
    })
		.when("/addpackage", {
        templateUrl : "addpackage.html",
        controller  : 'controlPackage'
    })
		.when("/addlanguage", {
        templateUrl : "addlanguage.html",
        controller  : 'controlLanguage'
    }).when("/adduser", {
        templateUrl : "adduser.html",
         controller  : 'controlUser'
    })
    .when("/media", {
        templateUrl : "media.html"
    }).when("/listservices", {
        templateUrl : "listservices.html",
           controller  : 'controlService'
    }).when("/listtransport", {
        templateUrl : "listtransport.html",
         controller  : 'controlTransport'
    }).when("/listocupation", {
        templateUrl : "listocupation.html",
         controller  : 'controlOcupation'
    }).when("/listpaxocupation", {
        templateUrl : "listpaxocupation.html",
        controller  : 'controlPaxOcupation'
    }).when("/price/:id", {
        templateUrl : "price.html",
        controller  : 'controlPrice'
    })
    .otherwise({
		templateUrl : 'home.html',
		//controller : 'tablaMateriales'
	});

});
