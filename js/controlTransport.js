//cree los controladores
appRouter.controller('controlTransport',function($scope,$http,$timeout){
  console.log("transport run");
  getTransport();
  getLanguage();
  $scope.transports;
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
      console.log("No se get  tags");
    });
  }
  //languages
  $scope.languages;
  function getLanguage(){
    var action=2;
    //console.log(action);
    $http.post('../php/transport.php', {'action':action})
    .success(function(data){
      $scope.languages = data;
      console.log("get language");
      //  console.log($scope.languages);
      // alert("get exitoso");
    }).error(function(response){
      console.log("No se get el Language");
    });
  }
  //funcion para agregar detalles
  $scope.addTransport = function($lang){
    var action=3;
    console.log("add");
    $http.post('../php/transport.php', {'action':action})//creo el tag
    .success(function(data){
      $scope.newTransport = data
      console.log("add transportype");
      console.log(data);
      //crear funcion para anadir detalle por idioma el siclo me jala los datos y podemos mandar el id del idioma como parametro
      for (var i = 0; i <  $lang.length; i++) {
        //  console.log("entro "+i+$scope.languages[i].short);
        var name= document.getElementById('name-'+$scope.languages[i].short).value;
        var langid = $scope.languages[i].id;

        $http.post('../php/transport.php', {'action':4,'id': $scope.newTransport[0].id,'language_id':langid,'name':name})//creo el tag
        .success(function(data){
          //console.log(data);
          console.log("se agrego service detail correctamente");
        }).error(function(response){
          console.log("No iserto service detail");
        });
      }//fin del for
      setTimeout(function () {//para que actualice los campos de forma eficiente
        $scope.$apply(function () {
          getTransport();
          console.log("se agrego nuevo service");
        });
      }, 200);

      // alert("get exitoso");
    }).error(function(response){
      console.log("No iserto service");
    });
  }
  //funcion para cambiar el estado
  $scope.changeenabled = function(id,enabled){
    console.log("estado actual "+enabled);
    var estado;
    if(enabled==0){
      estado=1;
    }else{
      estado=0;
    }
    var action=8;
    $http.post('../php/transport.php', {'action':action,'id':id,'enabled':estado})
    .success(function(data){
      console.log(data);
      getTransport();
      console.log("actulizado exitosamente el estado");
    }).error(function(response){
      console.log("No se actualizo el el estado");
    });
  }//fin funcioncambiar estado

  //funcion para mostrar datos en getLanguagetoModal
  $scope.getTransporttoModal=function(lang,id){
    //$scope.typeS
    getLanguage();
    $scope.idTransportE=id;
    var action=5;
    console.log(action);
    $scope.contador=0;
    $scope.vector=[];
    getTransport();
    for (var i = 0; i <  lang.length; i++) {
      var langid = $scope.languages[i].id;
      var short = $scope.languages[i].short;
      //console.log($scope.languages[i].short);
      $http.post('../php/transport.php', {'action':action,'id':id,'idlan':langid,'short':short})
      .success(function(data){
        $scope.transportE = data;
        console.log(data);
        var cont=$scope.contador;
        //  console.log(data);

        setTimeout(function () {//para que actualice los campos de forma eficiente
          $scope.$apply(function () {
            //console.log(data[0].name);
            $("#nameT-"+data[0].short).val(data[0].name);
            //  $("#descriptionE-"+data[0].short).val(data[0].description);
          });
        }, 300);

        //usamos el contador para saber si todas las peticiones se hiceron
        console.log("vector"+$scope.contador+" lang "+lang.length);
        $scope.contador=$scope.contador+1;
      }).error(function(response){
        console.log("No se get el tags");
      });

    }
  }


  $scope.editTransport =function($lang){
    var action=6;

    //console.log('edit'+langid);
    $scope.contador=0;
    for (var i = 0; i <  $lang.length; i++) {
      //  console.log("entro "+i+$scope.languages[i].short);
      var name= document.getElementById('nameT-'+$scope.languages[i].short).value;
      var langid = $scope.languages[i].id;
      $http.post('../php/transport.php', {'action':action,'id':$scope.idTransportE,'language_id':langid,'name':name})
      .success(function(data){
        console.log("editado");
        console.log(data);

        if($lang.length==$scope.contador+1){
          getTransport();
          getLanguage()
          console.log("guardado exitosamente");
        }
        $scope.contador++;
      }).error(function(response){
        console.log("No se actualizo ");
      });
    }
  }//fin funcon edit

  //funcion para eliminar por id
  $scope.deleteTransport = function(id){
    //console.log("id  "+id);
    var action=7;
    console.log(action);
    $("#confirmdelete").click(function(){
      $http.post("../php/transport.php",{'action':action,'id':id})
      .success(function(data){
        setTimeout(function () {//para que actualice los campos de forma eficiente
          $scope.$apply(function () {

            if(data=1){
              getTransport();
              console.log("se elimino exitosamente ");
            }else{
              console.log("Presento un error al eliminar ");
            }

          });
        }, 100);
      });
    });
  }//fin delete


});
