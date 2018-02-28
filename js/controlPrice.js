appRouter.controller('controlPrice',function($scope,$http,$timeout){
console.log("price run");
getPaxOcupation();
 getTransport();
getSeason();
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

function getPaxOcupation(){
  var action=1;
  // console.log(action);
  $http.post('../php/paxocupation.php', {'action':action})
  .success(function(data){
    $scope.paxs = data;
    //console.log("pax");
  //  console.log(data);
  }).error(function(response){
      console.log("No se get  pax");
  });
}

function getTransport(){
  var action=1;
  //  console.log(action);
  $http.post('../php/transport.php', {'action':action})
  .success(function(data){
    $scope.transports = data;
    //console.log("get transport");
  //  console.log(data);

  }).error(function(response){
    console.log("No se get  tags");
  });
}

function getSeason(){
  var action=3;
//  console.log(action);
  $http.post('../php/season.php', {'action':action})
  .success(function(data){
    //console.log("season");
  //  console.log(data);
    $scope.seasons = data;
  }).error(function(response){
      console.log("No se get el Season");
  });
}

});
