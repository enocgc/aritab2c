var appRouter = angular.module("aritab2c",[]);
var appRouterArita = angular.module("aritab2c",['ngRoute']);

appRouterArita.filter('paginacion', function(){
   return function(data, start){
     return data.slice(start);
   }
});
