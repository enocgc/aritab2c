//cree los controladores
appRouter.controller('controlProduct',function($scope,$http,$timeout){
  console.log("products run");
  getProduct();
  getLanguage();
  $scope.products;
  $scope.name;
  $scope.units = [
           {'id': 19, 'label': '200x100'},
           {'id': 21, 'label': '800x600'},
        ];

  $scope.data= $scope.units[0];
  function setName(name,index,length){
    $scope.products[index].namecountry=name;
  //  console.log($scope.products[index].namecountry+" i "+ length);
  }
  function setNameL(name,index,length){
      $scope.products[index].namelocation=name;
      //console.log($scope.products[index].namelocation+" i "+ length);
    }
  function getProduct(){
    var action=1;
    //  console.log(action);
    $http.post('../php/product.php', {'action':action})
    .success(function(data){
      $scope.contador=0;
      $scope.contador2=0;
      for(var i=0;i<data.length;i++){
        $http.post('../php/product.php', {'action':9,'id':data[i].country_id})
        .success(function(dataname){
          setName(dataname[0].name,$scope.contador,data.length);
          $scope.contador++;
        }).error(function(response){
            console.log("No se get  product");
        });

        $http.post('../php/product.php', {'action':10,'id':data[i].location_id})
        .success(function(data){
          //console.log(data);
          setNameL(data[0].name,$scope.contador2,data.length);
          $scope.contador2++;
        }).error(function(response){
          console.log("No se get  product");
        });

      }//fin del ciclo
      // $scope.products = $scope.datos;
      $scope.products=data;
      //console.log(data);
      console.log("get Product");

    }).error(function(response){
      console.log("No se get  product");
    });
  }
  //languages
  $scope.languages;
  function getLanguage(){
    var action=2;
    //console.log(action);
    $http.post('../php/product.php', {'action':action})
    .success(function(data){
      $scope.languages = data;
      console.log("get language");
      //  console.log($scope.languages);
      // alert("get exitoso");
    }).error(function(response){
      alert("No se get el Language");
    });
  }
  getService();
  function getService(){
    var action=12;
    //  console.log(action);
    $http.post('../php/product.php', {'action':action})
    .success(function(data){
    //  console.log(data);
      $scope.services = data;
      //console.log(data);
      console.log("get service");
    }).error(function(response){
      alert("No se get  tags");
    });
  }
getCountries();
  function getCountries(){
    var action=13;
    $http.post('../php/product.php', {'action':action})
    .success(function(data){
      //console.log(data);
      $scope.countries = data;
      console.log("peticion finalizada datos arriba para renderizar");
    }).error(function(response){
      alert("No se obtuvieron los countries");
    });
  }
getLocation();
  function getLocation(){
    var action=14;
    $http.post('../php/product.php', {'action':action})
    .success(function(data){
      //console.log("location");
      //console.log(data);
      $scope.locations = data;
      console.log("peticion finalizada datos arriba para renderizar");
    }).error(function(response){
      alert("No se obtuvieron los countries");
    });
  }
  //funcion para agregar detalles
  $scope.addService = function($lang){
    var action=3;
    if($scope.typeS=="Bylocation"){
      var bylocation=1;
      var byitinerary=0;
    }else if($scope.typeS=="ByItinerary"){
      var bylocation=0;
      var byitinerary=1;
    }else{
      var bylocation=0;
      var byitinerary=0;
    }

    console.log("bylocation "+bylocation+" byitinerary "+byitinerary);
    $http.post('../php/service.php', {'action':action,'bylocation':bylocation,'byitinerary':byitinerary})//creo el tag
    .success(function(data){
      $scope.newService = data;
      console.log(data);
      //crear funcion para anadir detalle por idioma el siclo me jala los datos y podemos mandar el id del idioma como parametro
      for (var i = 0; i <  $lang.length; i++) {
      //  console.log("entro "+i+$scope.languages[i].short);
        var name= document.getElementById('name-'+$scope.languages[i].short).value;
        var langid = $scope.languages[i].id;

        $http.post('../php/service.php', {'action':4,'id': $scope.newService[0].id,'language_id':langid,'name':name})//creo el tag
        .success(function(data){
          //console.log(data);
          console.log("se agrego service detail correctamente");
        }).error(function(response){
          alert("No iserto service detail");
        });
      }//fin del for
      setTimeout(function () {//para que actualice los campos de forma eficiente
        $scope.$apply(function () {
          getService();
          console.log("se agrego nuevo service");
        });
      }, 200);

      // alert("get exitoso");
    }).error(function(response){
      alert("No iserto service");
    });
  }

  //funcion para mostrar datos en getLanguagetoModal
  $scope.getServicetoModal=function(lang,id){
    //$scope.typeS
    getLanguage();
    $scope.idServiceE=id;
    var action=5;
    console.log($scope.idServiceE);
    console.log(action);
  $scope.contador=0;
      $scope.vector=[];
  getService();
    for (var i = 0; i <  lang.length; i++) {
      var langid = $scope.languages[i].id;
      var short = $scope.languages[i].short;
      //console.log($scope.languages[i].short);
      $http.post('../php/service.php', {'action':action,'id':id,'idlan':langid,'short':short})
      .success(function(data){
        $scope.ServicesE = data;
        console.log(data);
        var cont=$scope.contador;
      //  console.log(data);

           setTimeout(function () {//para que actualice los campos de forma eficiente
               $scope.$apply(function () {
                 console.log(data[0].name);
                 $("#nameE-"+data[0].short).val(data[0].name);
                //  $("#descriptionE-"+data[0].short).val(data[0].description);
               });
           }, 300);

        //usamos el contador para saber si todas las peticiones se hiceron
        console.log("vector"+$scope.contador+" lang "+lang.length);
        $scope.contador=$scope.contador+1;
      }).error(function(response){
        alert("No se get el product");
      });

    }
}
$scope.editService =function($lang){
var action=6;

//console.log('edit'+langid);
$scope.contador=0;
for (var i = 0; i <  $lang.length; i++) {
//  console.log("entro "+i+$scope.languages[i].short);
var name= document.getElementById('nameE-'+$scope.languages[i].short).value;
var langid = $scope.languages[i].id;
$http.post('../php/service.php', {'action':action,'id':$scope.idServiceE,'language_id':langid,'name':name})
.success(function(data){
  console.log("editado");
  //console.log(data);

  if($lang.length==$scope.contador+1){
    setTimeout(function () {//para que actualice los campos de forma eficiente
        $scope.$apply(function () {
          getService();
         //  $("#descriptionE-"+data[0].short).val(data[0].description);
        });
    }, 300);
    getLanguage()
      console.log("guardado exitosamente");
  }
  $scope.contador++;
}).error(function(response){
  console.log("No se actualizo ");
});
}
}//fin funcon edit

$scope.changeenabled = function(id,enabled){
  console.log(id+"estado actual "+enabled);
  var estado;
  if(enabled==0){
  var   estado=1;
  }else{
  var   estado=0;
  }
  console.log("nuevo estado "+estado);
  $http.post('../php/product.php', {'action':11,'id':id,'enabled':estado})
  .success(function(data){
    getProduct();
    console.log("actulizado exitosamente el estado");
  }).error(function(response){
    console.log("No se actualizo el el estado");
  });
}//fin funcioncambiar estado
//funcion para eliminar por id
$scope.deleteProduct = function(id){
console.log(id);
$("#confirmdelete").click(function(){
$http.post("../php/product.php",{'action':8,'id':id})
.success(function(data){
  console.log(data);
setTimeout(function () {//para que actualice los campos de forma eficiente
$scope.$apply(function () {

if(data=1){
getProduct();
console.log("se elimino exitosamente ");
}else{
console.log("Presento un error al eliminar ");
}

});
}, 300);
});
});
}//fin delete


});
