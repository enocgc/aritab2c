appRouter.controller('controlPrice',function($scope,$http,$timeout){
console.log("price run");
getConvinations();

function getConvinations(){
var action=1;
 $http.post('../php/price.php', {'action':action})
 .success(function(data){
  $scope.convinations = data;
 console.log(data);
 }).error(function(response){

 });
}


});
