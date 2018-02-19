appRouter.controller('controlPackage',function($scope,$http,$timeout,$rootScope){
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
      //console.log(data);
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
      //console.log(data);
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
      //  console.log(data);
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
      //  console.log(data);
      $scope.products = data;
    }).error(function(response){
      console.log("No se obtuvieron los products");
    });
  }

  $scope.days=[];
  $scope.newlocations=[];
  $scope.cont=0;
  $scope.cont2=1;
  $scope.currentDay=0;
  $scope.currentDayF=1;

  $scope.addNewDay= function(day,locationID){
    $scope.days[$scope.currentDay]={'day':$scope.currentDayF+1,'locationID':locationID,'transfer':false};
    $scope.currentDay++;
      $scope.currentDayF++;
    console.log($scope.days);
     // ordenarByLocation();
     ordenar();
  }
  //esta funcion crea los location

function ordenar(){

    const l = $scope.days.length;
    for (let i = 0; i < l; i++ ) {
      for (let j = 0; j < l - 1 - i; j++ ) {
        if ( $scope.days[ j ].locationID > $scope.days[ j + 1 ].locationID ) {
          [ $scope.days[ j ].locationID, $scope.days[ j + 1 ].locationID ] = [ $scope.days[ j + 1 ].locationID, $scope.days[ j ].locationID ];
        }
      }
    }
    console.log($scope.days);
}//fin metodo ordenamiento

  $scope.addDays= function(days){
    console.log($scope.newlocations);
    $scope.newlocations[$scope.cont2-1]={'location': $scope.cont2};
    console.log("locations");
    console.log($scope.newlocations);
    $scope.cont=  $scope.cont+days;
    console.log("dias agregar "+ days+" al locations"+  $scope.cont2+" y el dia actual es "+ $scope.currentDay);

    for (var i=0; i <= days; i++) {
      $scope.currentDay++;
      $scope.currentDayF++;
      console.log("contador#2-> "+$scope.cont2);
      console.log("Diay actaulF-> "+$scope.currentDayF);
      console.log("dias length "+$scope.days.length);
      if(i==0){
        $scope.days[$scope.currentDay-1]={'day':$scope.currentDayF,'locationID':$scope.cont2,'transfer':true};
      }else{
        $scope.days[$scope.currentDay-1]={'day':$scope.currentDayF,'locationID':$scope.cont2,'transfer':false};
      }
    }//fin del for
    console.log($scope.days);

    $scope.cont2++;
        ordenar();

  }
$('.uk-checkbox').click(function(){
  alert(this.id);
});

  $scope.selectedTag;
  $scope.addPackage = function(){


    console.log($scope.selectedTag);
    console.log($scope.selectedTransport);
  }
});
