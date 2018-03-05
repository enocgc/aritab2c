appRouter.controller('controlPackage', function($scope, $http, $timeout, $rootScope) {
  console.log("controlPackage");
  getLanguage();
  getTransport();
  getTags();
  getLocation();
  getService();
  getPackage();
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

  function getPackage(){
    var action=9;
    //  console.log(action);
    $http.post('../php/package.php', {'action':action})
    .success(function(data){
      $scope.packages = data;
      console.log(data);
      //console.log(data);
      console.log("get package");
    }).error(function(response){
        console.log("No se get  package");
    });
  }

  $scope.changeenabled = function(id,enabled){
    var estado;
    if(enabled==0){
       estado=1;
    }else{
       estado=0;
    }
    var action=10;
      console.log("ID" +id+" enabled "+estado);
    $http.post('../php/package.php', {'action':action,'id':id,'enabled':estado})
    .success(function(data){
      getPackage();
      $.toast({
      heading: 'Success',
      text: 'Change state.',
      showHideTransition: 'slide',
      icon: 'success'
    });
    }).error(function(response){
      $.toast({
        heading: 'Error',
        text: 'Not Change state.',
        showHideTransition: 'fade',
        icon: 'error'
    });
    });
  }//fin funcioncambiar estado

  //funcion para eliminar por id
  $scope.deletePackage = function(id){
      console.log("id package:  "+id);
    var action=11;
    console.log(action);
    $("#confirmdelete").click(function(){
      $http.post("../php/package.php",{'action':action,'id':id})
      .success(function(data){
        setTimeout(function () {//para que actualice los campos de forma eficiente
            $scope.$apply(function () {
              if(data=1){
                getPackage();
                $.toast({
                  heading: 'Success',
                  text: 'Delete Package.',
                  showHideTransition: 'fade',
                  icon: 'error'
              });
              }else{
                      console.log("Presento un error al eliminar ");
              }

            });
        }, 300);
        //console.log("id season:  "+id);
      });
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
      }).error(function(response) {});
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
      }).error(function(response) {});
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
      'idproduct': null,
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

  function renameNumber() {
    for (var i = 0; i < $scope.days.length; i++) {
      $scope.days[i].day = i + 1;
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
      'position': $scope.position,
      'acomodation': $scope.acomodation.name,
      'acomodationid': $scope.acomodation.id
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
        'product': null,
        'idproduct': null,
      };
    } //fin del for
    //  console.log($scope.days);
    $scope.cont2++;
    ordenar();
    console.log("antes");
    console.log($scope.days);
  }

  //eliminar day
  $scope.deleteDay = function(day, location) {
    for (var i = 0; i < $scope.days.length; i++) {
      if ($scope.days[i].day == day) {
        console.log("spplice " + i + " day  scope" + $scope.days[i].day + " dia" + day);
        $scope.days.splice(i, 0);
        var elementoEliminado = $scope.days.splice(i, 1);
        renameNumber();
        ordenar();
        // console.log("eliminado");
        // console.log(elementoEliminado);
      }
    } //fin del for
    console.log("despues");
    console.log($scope.days);
    // console.log("currentday"+$scope.currentDay);
    // console.log("currentdayF"+$scope.currentDayF);
    $scope.currentDay = $scope.currentDay - 1;
    $scope.currentDayF = $scope.currentDayF - 1;
    console.log("day " + day + " location id " + location);

  }

  //eliminar actividad por dia
  $scope.removeProduct = function(day, ) {
    for (var i = 0; i < $scope.days.length; i++) {
      if ($scope.days[i].day == day) {
        console.log("entro al if");
        $scope.days[i].product = null;
      }
    } //fin del for
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
        $scope.days[i].product = name;
        $scope.days[i].idproduct = id;
      }
    }
  } //fin add product por dia


  //funcion para agregar paquete
  $scope.addPackage = function() {

    var action = 1;
    $http.post('../php/package.php', {
        'action': action
      }) //creo el tag
      .success(function(data) {
        $scope.addPackageDetails(data);
        $scope.addpackagetransport(data);
        $scope.addpackagetag(data);
        $scope.packageroutes(data);
      }).error(function(response) {
        console.log("No iserto package");
      });
  } //fin del add paquete

  $scope.addPackageDetails = function(data) {
    console.log(data);
    $scope.newPackage = data;
    for (var i = 0; i < $scope.languages.length; i++) {
      var name = document.getElementById('name-' + $scope.languages[i].short).value;
      var description = document.getElementById('description-' + $scope.languages[i].short).value;
      var langid = $scope.languages[i].id;
      var datos = {
        'action': 2,
        'package_id': $scope.newPackage[0].id,
        'language_id': langid,
        'name': name,
        'description': description
      };
      // console.log("agregando en id "+$scope.newPackage[0].id);

      $http.post('../php/package.php', datos) //creo el tag
        .success(function(data) {

        }).error(function(response) {
          console.log("No agrego el package details");
        });
    }
  } // end to addPackageDetails

  //funcion para agrgar el paquete de transporte
  $scope.addpackagetransport = function(data) {
    var action = 3;
    $scope.newPackage = data;
    for (var i = 0; i < $scope.dataTransport.length; i++) {
      $scope.dataTransport[i].id;
      $http.post('../php/package.php', {
          'action': action,
          'package_id': $scope.newPackage[0].id,
          'transporttype_id': $scope.dataTransport[i].id
        })
        .success(function(data) {

        }).error(function(response) {
          console.log("No iserto package");
        });
    }
  }

  //funcion para agrgar el paquete de tags
  $scope.addpackagetag = function(data) {
    var action = 4;
    $scope.newPackage = data;
    for (var i = 0; i < $scope.dataTag.length; i++) {
      $scope.dataTransport[i].id;
      $http.post('../php/package.php', {
          'action': action,
          'package_id': $scope.newPackage[0].id,
          'tag_id': $scope.dataTransport[i].id
        })
        .success(function(data) {
          // console.log(data);
        }).error(function(response) {
          console.log("No iserto package");
        });
    }
  }
  //funcion para obtener minnigth por location
  $scope.getCountDays = function(id) {
    var cont = 0;
    for (var j = 0; j < $scope.days.length; j++) {
      if ($scope.days[j].locationID == id) {
        cont++;
      } //fin del if
    } //fin for days
    return cont;
  } //end to getCountDays

  //funcion para cantidad de excursiones por locacion
  $scope.getCountProductEx = function(id) {
    var cont = 0;
    for (var j = 0; j < $scope.days.length; j++) {

      if ($scope.days[j].locationID == id && $scope.days[j].idproduct != null) {

        cont++;
      } //fin del if
    } //fin for days
    return cont;
  } //end to getCountDays

  //funcion para agregar packageroutes
  $scope.packageroutes = function(data) {
    $scope.newPackage = data;
    var action = 5;
    var canditidadDias
    //console.log(data);
    for (var i = 0; i < $scope.newlocations.length; i++) {
      $scope.newlocations[i];
      //console.log($scope.newlocations[i]);
      canditidadDias = $scope.getCountDays($scope.newlocations[i].location);
      // console.log("dias "+canditidadDias);
      var position = $scope.newlocations[i].position;
      if ($scope.newlocations[i].position == null) {
        position = 0;
      }
      $http.post('../php/package.php', {
          'action': action,
          'package_id': $scope.newPackage[0].id,
          'location_id': $scope.newlocations[i].id,
          'id_location': $scope.newlocations[i].location,
          'position': position,
          'minnights': canditidadDias,
          'acomodationid': $scope.newlocations[i].acomodationid
        })
        .success(function(data) {
          console.log(data);
          var id = $scope.idpackageroute = data;
          $scope.packageroute_services($scope.idpackageroute[0].id);
          $scope.packageroute_products($scope.idpackageroute[0].id, $scope.idpackageroute[0].acomodationid, $scope.idpackageroute[0].id_location);
        }).error(function(response) {
          console.log("No iserto package");
        });
      //post
    } //fin for locations
  }
  //funcion insert packageroute_services
  $scope.packageroute_services = function(id) {
    var action = 6;
    for (var i = 0; i < $scope.newlocations.length; i++) {
      $scope.getCountProductEx($scope.newlocations[i].location);
      var quantityAcomodation = $scope.getCountDays($scope.newlocations[i].location);
      var quantity = ($scope.getCountProductEx($scope.newlocations[i].location));

      $http.post('../php/package.php', {
          'action': action,
          'packageroute_id': id,
          'quantityAcomodation': quantityAcomodation,
          'quantity': quantity
        })
        .success(function(data) {
          // console.log(data);
        }).error(function(response) {
          console.log("No iserto packageroute_services");
        });

    }
  } //fin de packageroute_services
  //funcion insert packageroute_products
  var peticiones = 0;
  $scope.packageroute_products = function(id, idacomodation, id_location) {
    var action = 7;
    // console.log("PACKAGEID "+id+" ID ACOMODATION "+idacomodation+" location_id "+ id_location);
    for (var i = 0; i < $scope.days.length; i++) {
      if ($scope.days[i].locationID == id_location) {
        peticiones++;
        var datos = {
          'action': action,
          'day': $scope.days[i].day,
          'packageroutes': id,
          'idacomodation': idacomodation
        }
        $http.post('../php/package.php', datos)
          .success(function(data) {
            console.log(data);
          }).error(function(response) {
            console.log("No iserto packageroute_services");
          }); //post
        console.log("agregar packageroute" + id + " service_id" + 2 + " product_id " + idacomodation + " day " + $scope.days[i].day);
        if ($scope.days[i].idproduct != null) {
          $http.post('../php/package.php', {
              'action': 8,
              'day': $scope.days[i].day,
              'idProduct': $scope.days[i].idproduct,
              'packageroutes': id,
            })
            .success(function(data) {
              console.log(data);
            }).error(function(response) {
              console.log("No iserto packageroute_services");
            }); //post
          console.log("agregar packageroute" + id + " service_id" + 3 + " product_id " + $scope.days[i].idproduct + " day " + $scope.days[i].day);
        }
      }
    }
  } //fin funcion insert packageroute_products

});
