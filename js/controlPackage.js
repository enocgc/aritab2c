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
        //  console.log(data);
        $scope.locations = data;
        //console.log("peticion finalizada datos arriba para renderizar");
      }).error(function(response) {
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
      }).error(function(response) {
      });
  }
  //funcion para obtener los acomodation
  function getProductAcomodation(id) {
    var action = 19;
    $http.post('../php/product.php', {
        'action': action,
        'id': id
      })
      .success(function(data) {

        $scope.acomodations = data;
      }).error(function(response) {
        console.log("No se obtuvieron los products");
      });
  }
  //funcion para obtener las excursiones
  function getProduct(id) {
  //  console.log("Product");
    var action = 20;
    $http.post('../php/product.php', {
        'action': action,
        'id': id
      })
      .success(function(data) {
      //  console.log("location by id");
      //  console.log(data);
        $scope.products = data;
      }).error(function(response) {
      //  console.log("No se obtuvieron los products");
      });
  }
  //cargar productos por location
  $scope.loadProduct = function(id, day) {
    getProduct(id);
    $scope.daytoproduct = day;
  }


  $scope.days = [];
  $scope.newlocations = [];
  $scope.cont = 0;
  $scope.cont2 = 1;
  $scope.currentDay = 0;
  $scope.currentDayF = 0;

  $scope.addNewDay = function(day, locationID) {
    console.log(locationID);
    $scope.days[$scope.currentDay] = {
      'day': $scope.currentDayF + 1,
      'locationID': locationID,
      'product': null,
    };
    $scope.currentDay++;
    $scope.currentDayF++;
  //  console.log($scope.days);
    ordenar();

  }


  function ordenar() {
  //  console.log($scope.days);
    const l = $scope.days.length;
    for (let i = 0; i < l; i++) {
      for (let j = 0; j < l - 1 - i; j++) {
        if ($scope.days[j].locationID > $scope.days[j + 1].locationID) {
          [$scope.days[j].locationID, $scope.days[j + 1].locationID] = [$scope.days[j + 1].locationID, $scope.days[j].locationID];
          [$scope.days[j].product, $scope.days[j + 1].product] = [$scope.days[j + 1].product, $scope.days[j].product];
        }
      }
    }
  //  console.log($scope.days);
  } //fin metodo ordenamiento

  function renameNumber(){
    for (var i = 0; i < $scope.days.length; i++) {
      $scope.days[i].day=i+1;
    }
  }

  $scope.addDays = function(days, id) {
    function find(locat) {
      return locat.id === id;
    }
    var name = ($scope.locations.find(find).name);
    //  console.log(name);
    var idLocation = ($scope.locations.find(find).id);
  //  console.log($scope.acomodation);
    $scope.newlocations[$scope.cont2 - 1] = {
      'location': $scope.cont2,
      'name': name,
      'id': idLocation,
      'positon': $scope.position,
      'acomodation': $scope.acomodation.name
    };
    //console.log($scope.newlocations);


    $scope.cont = $scope.cont + days;
    //console.log("dias agregar "+ days+" al locations"+  $scope.cont2+" y el dia actual es "+ $scope.currentDay);
    for (var i = 0; i < days; i++) {
      $scope.currentDay++;
      $scope.currentDayF++;
      $scope.days[$scope.currentDay - 1] = {
        'day': $scope.currentDayF,
        'locationID': $scope.cont2,
        'product': null,
      };
    } //fin del for
  //  console.log($scope.days);
    $scope.cont2++;
    ordenar();
    console.log("antes");
    console.log($scope.days);
  }



  $scope.addPackage = function() {
    console.log($scope.dataTag);
    console.log($scope.dataTransport);
  }

  //eliminar day
  $scope.deleteDay = function(day, location) {
    for (var i = 0; i < $scope.days.length; i++) {
      if ($scope.days[i].day == day ) {
        console.log("spplice "+ i+ " day  scope"+$scope.days[i].day+" dia"+ day);
        $scope.days.splice(i,0);
        var elementoEliminado = $scope.days.splice(i,1);
            renameNumber();
            ordenar();
        // console.log("eliminado");
        // console.log(elementoEliminado);
      }
    }    //fin del for
        console.log("despues");
    console.log($scope.days);
    // console.log("currentday"+$scope.currentDay);
    // console.log("currentdayF"+$scope.currentDayF);
    $scope.currentDay = $scope.currentDay-1;
  $scope.currentDayF = $scope.currentDayF-1;
    console.log("day " + day + " location id " + location);

  }

  //eliminar actividad por dia
  $scope.removeProduct=function(day,){
    for (var i = 0; i < $scope.days.length; i++) {
      if ($scope.days[i].day == day) {
        console.log("entro al if");
        $scope.days[i].product = null ;
      }
    }//fin del for
  }

  //seleccionar la location
  $scope.selectLocation = function(id) {
    getProductAcomodation(id);
    $(".locaciones").css("background", "none");
    $("#locations" + id).css("background-color", "#c1e0ee");
    $scope.idlocation = id;
  //  console.log(id);
  }
  //seleccionar el producto y obtener el id
  $scope.selectProduct = function(id) {
    $(".productos").css("background", "none");
    $("#products" + id).css("background-color", "#c1e0ee");
    $scope.idproduct = id;
  }

  //agregar producto al view
  $scope.addProduct = function(id, day) {
    function find(produ) {
      return produ.id === id;
    }
    var name = ($scope.products.find(find).name);
    //console.log($scope.products.find(find));
    console.log("id dia " + day + " nombre product " + name);
    for (var i = 0; i < $scope.days.length; i++) {
      if ($scope.days[i].day == day) {
        console.log("entro al if");
        $scope.days[i].product = name ;
      }
    }
  }//fin add product por dia

  //
});
