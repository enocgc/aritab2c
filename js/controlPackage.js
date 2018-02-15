appRouter.controller('controlPackage',function($scope,$http,$timeout){
  console.log("controlPackage");

  getLanguage();
  getTransport();
  getTags();

  function getLanguage(){
    var action=2;
    //console.log(action);
    $http.post('../php/tags.php', {'action':action})
    .success(function(data){
      $scope.languages = data;
    }).error(function(response){
      alert("No se get el Language");
    });
  }

  function getTransport(){
    var action=1;
    //  console.log(action);
    $http.post('../php/transport.php', {'action':action})
    .success(function(data){
      $scope.transports = data;
      console.log(data);
      console.log("get service");


      //  console.log($scope.seasons);
      // alert("get exitoso");
    }).error(function(response){
      alert("No se get  tags");
    });
  }
  function getTags(){
    var action=9;
    //  console.log(action);
    $http.post('../php/tags.php', {'action':action})
    .success(function(data){
      $scope.tags = data;
      console.log(data);
      //  console.log($scope.seasons);
      // alert("get exitoso");
    }).error(function(response){
      alert("No se get  tags");
    });
  }

});
