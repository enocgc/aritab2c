appRouter.controller('controlLocations',function($scope,$http,$timeout){
$scope.locations;
$scope.languages;

getLocations();
getLanguage();

function getLocations(){
  console.log("locations");
  var action=1;
  $http.post('../php/locations.php', {'action':action})
  .success(function(data){
    console.log(data);
    $scope.locations = data;
  }).error(function(response){
    alert("No se obtuvieron los countries");
  });
}

function getLanguage(){
  var action=2;
  $http.post('../php/tags.php', {'action':action})
  .success(function(data){
    $scope.languages = data;
  }).error(function(response){
    alert("No se get el Language");
  });
}

$scope.changeenabled=function(id,enabled){
  console.log(id+"estado actual "+enabled);
  var estado;
  if(enabled==0){
     estado=1;
  }else{
     estado=0;
  }
  var action=2;
  $http.post('../php/locations.php', {'action':action,'id':id,'enabled':estado})
  .success(function(data){
    console.log(data);
    getLocations();
  }).error(function(response){
    console.log("No se actualizo el el estado");
  });
}//fin funcioncambiar estado

//process to delete
$scope.itemToDelete;
$scope.deleteCountryDetails=function(id){ $scope.itemToDelete=id;}// end to delte country details
$scope.confirmdelete=function(){
  var action=3;
  $http.post('../php/locations.php', {'action':action,'language_id':$scope.itemToDelete})
  .success(function(data){
    $scope.countries = data;
    getCountries();
  }).error(function(response){
    alert("No se obtuvieron los countries");
  });
}
});// FIN  del controlador
