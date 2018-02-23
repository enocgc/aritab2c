appRouter.controller('controlPackage', function($scope, $http, $timeout, $rootScope) {
  console.log("controlPackage");
  getLanguage();
  getTransport();
  getTags();
  getLocation();
  getService();

  function getLanguage() {
    var action = 2;
    //console.log(action);
    $http.post('../php/tags.php', {
        'action': action
      })
      .success(function(data) {
        $scope.languages = data;
      }).error(function(response) {
        console.log("No se get el Language");
      });
  }

  function getTransport() {
    var action = 1;
    //  console.log(action);
    $http.post('../php/transport.php', {
        'action': action
      })
      .success(function(data) {
        $scope.transports = data;
        //console.log(data);
        console.log("get transport");
        //  console.log($scope.seasons);
        // alert("get exitoso");
      }).error(function(response) {
        console.log("No se get  transport");
      });
  }

  function getTags() {
    var action = 9;
    //  console.log(action);
    $http.post('../php/tags.php', {
        'action': action
      })
      .success(function(data) {
        $scope.tags = data;
        //console.log(data);
        //  console.log($scope.seasons);
        // alert("get exitoso");
      }).error(function(response) {
        console.log("No se get  tags");
      });
  }


  $scope.locations;

  function getLocation() {
    var action = 14;
    $http.post('../php/product.php', {
        'action': action
      })
      .success(function(data) {
        console.log("location");
        //  console.log(data);
        $scope.locations = data;
        //console.log("peticion finalizada datos arriba para renderizar");
      }).error(function(response) {
        console.log("No se obtuvieron los location");
      });
  }

  function getService() {
    var action = 12;
    //  console.log(action);
    $http.post('../php/product.php', {
        'action': action
      })
      .success(function(data) {
        //console.log(data);
        $scope.services = data;
        //console.log(data);
        console.log("get service");
      }).error(function(response) {
        console.log("No se get  service");
      });
  }

  function getProduct(id) {
    console.log("Product");
    var action = 19;
    $http.post('../php/product.php', {
        'action': action,'id':id
      })
      .success(function(data) {
        console.log("location by id");
         console.log(data);
        $scope.products = data;
      }).error(function(response) {
        console.log("No se obtuvieron los products");
      });
  }
//cargar productos por location
  $scope.loadProduct=function(id,day){
      getProduct(id);
      $scope.daytoproduct = day;
  }


  $scope.days = [];
  $scope.newlocations = [];
  $scope.cont = 0;
  $scope.cont2 = 1;
  $scope.currentDay = 0;
  $scope.currentDayF = 1;

  $scope.addNewDay = function(day, locationID) {
    $scope.days[$scope.currentDay] = {
      'day': $scope.currentDayF + 1,
      'locationID': locationID,
      'transfer': true
    };
    $scope.currentDay++;
    $scope.currentDayF++;
    console.log($scope.days);
    ordenar();
    updateLastTranfer(locationID);
  }
  //funcion para agregar primer transfer
  $scope.addNewDayTransfer = function(day,locationID){
    $(".titlelocate01-1").hide();
    console.log("day "+day+" location "+locationID);
    $scope.days[$scope.currentDay] = {
      'day': $scope.currentDayF + 1,
      'locationID': locationID,
      'transfer': true
    };
    $scope.days[0].transfer=true;
    $scope.currentDay++;
    $scope.currentDayF++;
    ordenar();
    updateLastTranfer(locationID);
    $(".addtransfer").hide();
  }

  function updateLastTranfer(id){

    for(var i=0;i<$scope.days.length;i++){
      // if($scope.days[i].locationID!=id){
          var pos=getLastPostDay($scope.days[i].locationID);
          $scope.days[pos-1].transfer=false;
          $scope.days[pos].transfer=true;
      // }//if1
    }//for
  }//updateLastTranfe
  function getLastPostDay(id){
    var postLastDayLocation;
    for(var i=0;i<$scope.days.length;i++){
        if($scope.days[i].locationID==id){
          postLastDayLocation=i;
        }
    }
    return postLastDayLocation;
  }
//funcion para cargar transfer despues de cada location location
  function addTransferLastDayLocation(locationID){
    var postLastDayLocation;
    for(var i=0;i<$scope.days.length;i++){
        if($scope.days[i].locationID==locationID){
          postLastDayLocation=i;
        }
    }

    $scope.days[$scope.currentDay] = {
      'day': $scope.currentDayF + 1,
      'locationID': locationID,
      'transfer': false
    };
    $scope.currentDay++;
    $scope.currentDayF++;
    $scope.days[postLastDayLocation+1].transfer=true;
  }// end to addTransferLastDayLocation

  //esta funcion crea los location

  function ordenar() {
    console.log($scope.days);
    const l = $scope.days.length;
    for (let i = 0; i < l; i++) {
      for (let j = 0; j < l - 1 - i; j++) {
        if ($scope.days[j].locationID > $scope.days[j + 1].locationID) {
          [$scope.days[j].locationID, $scope.days[j + 1].locationID] = [$scope.days[j + 1].locationID, $scope.days[j].locationID];
          [$scope.days[j].transfer, $scope.days[j + 1].transfer] = [$scope.days[j + 1].transfer, $scope.days[j].transfer];
        }
      }
    }
    console.log($scope.days);
  } //fin metodo ordenamiento

  $scope.addDays = function(days, id) {
  $(".titlelocate01-1").show();
    function find(locat) {
      return locat.id === id;
    }
    var name = ($scope.locations.find(find).name);
  //  console.log(name);
    var idLocation= ($scope.locations.find(find).id);
    //console.log(idLocation);
    $scope.newlocations[$scope.cont2 - 1] = {
      'location': $scope.cont2,
      'name': name,
      'id': idLocation,
      'positon': $scope.position
    };
console.log($scope.newlocations);


    $scope.cont = $scope.cont + days;
    //console.log("dias agregar "+ days+" al locations"+  $scope.cont2+" y el dia actual es "+ $scope.currentDay);
    for (var i = 0; i < days; i++) {
      $scope.currentDay++;
      $scope.currentDayF++;
        $scope.days[$scope.currentDay - 1] = {
          'day': $scope.currentDayF,
          'locationID': $scope.cont2,
          'transfer': false
        };
    } //fin del for
    if($scope.newlocations.length == 1){
        $(".titlelocate01-1").css("display","none");
        $scope.titleLocation1=name;
        $scope.idday=2;
    }

    console.log($scope.days);
  addTransferLastDayLocation($scope.cont2);
    $scope.cont2++;
    ordenar();
  }

  $('.uk-checkbox').click(function() {
    alert(this.id);
  });

  $scope.selectedTag;
  $scope.selectedTransport2 = 1;
  $scope.addPackage = function() {
    console.log($scope.selectedTag);
    console.log($scope.selectedTransport);
  }
  // pruebacheckbox
  $scope.disabled = 'false';
  $scope.cambiarEstado = function(id, prueba) {
    if (prueba != 0) {
      console.log(id);
    }

    //esta funcion la puse yo y si funca
  }
  $('.locaciones').click(function() {
    alert(this.id);
  });
  $('.productos').click(function() {
    alert(this.id);
  });
  //eliminar day
  $scope.deleteDay = function(day,location) {
    console.log("day "+day+" location id "+location);
  }

  //seleccionar la location
  $scope.selectLocation = function(id) {
    $(".locaciones").css("background", "none");
    $("#locations" + id).css("background-color", "#c1e0ee");
    $scope.idlocation = id;

  }
//seleccionar el producto y obtener el id
  $scope.selectProduct = function(id) {
    $(".productos").css("background", "none");
    $("#products" + id).css("background-color", "#c1e0ee");
    $scope.idproduct = id;
  }

//agregar producto al view
  $scope.addProduct = function(id,day) {

    function find(produ) {
      return produ.id === id;
    }
    var name = ($scope.products.find(find).name);
    console.log($scope.products.find(find));
    console.log("id dia " + day + " nombre product " + name);
  }
  //
});
