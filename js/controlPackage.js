appRouter.controller('controlPackage',function($scope,$http,$timeout){
  console.log("controlPackage");
  getLanguage();
  getTransport();
  getTags();
  getLocation();
  getService();
  getProduct()
  function getLanguage(){
    var action=2;
    //console.log(action);
    $http.post('../php/tags.php', {'action':action})
    .success(function(data){
      $scope.languages = data;
    }).error(function(response){
        console.log("No se get el Language");
    });
  }

  function getTransport(){
    var action=1;
    //  console.log(action);
    $http.post('../php/transport.php', {'action':action})
    .success(function(data){
      $scope.transports = data;
      console.log(data);
      console.log("get transport");
      //  console.log($scope.seasons);
      // alert("get exitoso");
    }).error(function(response){
        console.log("No se get  transport");
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
        console.log("No se get  tags");
    });
  }
    function getLocation(){
      var action=14;
      $http.post('../php/product.php', {'action':action})
      .success(function(data){
        console.log("location");
        console.log(data);
        $scope.locations = data;
        //console.log("peticion finalizada datos arriba para renderizar");
      }).error(function(response){
          console.log("No se obtuvieron los location");
      });
    }

    function getService(){
      var action=12;
      //  console.log(action);
      $http.post('../php/product.php', {'action':action})
      .success(function(data){
        console.log(data);
        $scope.services = data;
        //console.log(data);
        console.log("get service");
      }).error(function(response){
          console.log("No se get  service");
      });
    }

    function getProduct(){
        console.log("Product");
        var action=18;
        $http.post('../php/product.php', {'action':action})
        .success(function(data){
          console.log(data);
          $scope.products = data;
        }).error(function(response){
          console.log("No se obtuvieron los products");
        });
      }

$scope.selectedTag;
$scope.addPackage = function(){
  console.log($scope.selectedTag);
  console.log($scope.selectedTransport);
}
});
