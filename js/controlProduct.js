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
  //funcion para agregar
  $scope.addProduct = function($lang){
    var action=4;
    var data={
        'action':action,
        'service_id':$scope.selectedService.id,
        'country_id':$scope.selectedCountry.id,
        'location_id':$scope.selectedLocation.id,
        'gpslat':$scope.latitude,
        'gpslong':$scope.longitude,
        'gpszoom':$scope.zoom
      };
    $http.post('../php/product.php',data)//creo el tag
    .success(function(data){
      $scope.newProduct = data;
      for (var i = 0; i <  $lang.length; i++) {
        console.log("entro "+i+$scope.languages[i].short);
        var name= document.getElementById('name-'+$scope.languages[i].short).value;
        var description= document.getElementById('description-'+$scope.languages[i].short).value;
        var langid = $scope.languages[i].id;
        var datos={
          'action':5,
          'product_id':$scope.newProduct[0].id,
          'language_id':langid,
          'name':name,
          'description':description
        };
        console.log("agregando en id "+$scope.newProduct[0].id);
        $http.post('../php/product.php',datos)//creo el tag
        .success(function(data){
          console.log("se agrego el country details correctamente"+data);
        }).error(function(response){
          alert("No agrego el product details");
        });
      }//fin del for

      // $country_id,$media_id,$template_id,$position
      var datos={
          'action':6,
          'product_id':$scope.newProduct[0].id,
          'media_id':777,
          'template_id':$scope.data.id,
          'position':$scope.position
        };
        $http.post('../php/product.php',datos)//creo el tag
        .success(function(data){
          console.log("se agrego el country media correctamente"+data);
        }).error(function(response){
          alert("No agrego el product media");
        });

      setTimeout(function () {//para que actualice los campos de forma eficiente
          $scope.$apply(function () {
            // getTags();
            console.log("final");
          });
      }, 100);

      // alert("get exitoso");
    }).error(function(response){
      alert("No iserto product");
    });
  }//fin del add product

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
