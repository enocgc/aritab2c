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
      console.log("Product");
      var action=1;
      $http.post('../php/product.php', {'action':action})
      .success(function(data){
        $scope.products = data;
      }).error(function(response){
        console.log("No se obtuvieron los products");
      });
    }

  //languages
  $scope.languages;
  function getLanguage(){
    var action=2;
    //console.log(action);
    $http.post('../php/tags.php', {'action':action})
    .success(function(data){
      $scope.languages = data;
      console.log("get language");
    }).error(function(response){
        console.log("No se get el Language");
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
        console.log("No se get  service");
    });
  }
getCountries();
  function getCountries(){
    var action=13;
    $http.post('../php/product.php', {'action':action})
    .success(function(data){
    //  console.log(data);
      $scope.countries = data;
      console.log("peticion finalizada datos arriba para renderizar");
    }).error(function(response){
        console.log("No se obtuvieron los countries");
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
      //console.log("peticion finalizada datos arriba para renderizar");
    }).error(function(response){
        console.log("No se obtuvieron los location");
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
            console.log("No agrego el product details");
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
            console.log("No agrego el product media");
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
    $.toast({
    heading: 'Success',
    text: 'Estate has be change.',
    showHideTransition: 'slide',
    icon: 'success'
});
  }).error(function(response){
    $.toast({
      heading: 'Error',
      text: 'Not change state',
      showHideTransition: 'fade',
      icon: 'error'
  });
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



$scope.idEdit;
$scope.getEditProduct=function(id){
  $scope.idEdit=id;
  var datos={
    'action':7,
    'id':id
  };
  $http.post('../php/product.php',datos)
  .success(function(data){
  //  console.log(data);
    $scope.countrymap = data;
    createMarker(data[0].gpslat,data[0].gpslong,data[0].gpszoom);
    $scope.productsE=data;

      //$("#serviceE").text(data[0].service_id);//Mae es un vector {id:'valor','label':titulo}
    //$scope.selectedCountry=data[0].country_id;
    //$scope.selectedLocation=data[0].location_id;
    $scope.latitude=data[0].gpslat;
    $scope.longitude=data[0].gpslong;
    $scope.zoom=data[0].gpszoom;
  }).error(function(response){
    alert("No se obtuvieron los Product");
  });
  // language
  datos={
    'action':2,
    'id':id
  };
  $http.post('../php/product.php',datos)
  .success(function(data){
    //console.log(data);
    for(var i=0;i<data.length;i++){
      $("#nameP-"+data[i].language_id).val(data[i].name);
      $("#descriptionP-"+data[i].language_id).val(data[i].description);
    }
  }).error(function(response){
    alert("No se obtuvieron los Product");
  });

  datos={
    'action':15,
    'id':id
  };
  $http.post('../php/product.php',datos)
  .success(function(data){
    //console.log(data);
    $scope.positionE=data[0].position;
  }).error(function(response){
    alert("No se obtuvieron los Product");
  });

}//end to getEditCoutnry

function markMap(lat,lng,zoom) {
  var myLatLng = {lat:parseFloat(lat), lng:parseFloat(lng)};

  var map = new google.maps.Map(document.getElementById('map-canvas'), {
    zoom: parseInt(zoom),
    center: myLatLng
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: ''
  });
}
// $id,$gpslat,$gpslong,$gpszoom,$media_id,$template_id,$position
$scope.updateProduct=function(){
   var datos={
    'action':16,
    'id':$scope.idEdit,
    'service_id':$scope.selectedService.id,
    'country_id':$scope.selectedCountry.id,
    'location_id':$scope.selectedLocation.id,
    'gpslat':$scope.latitude,
    'gpslong':$scope.longitude,
    'gpszoom':$scope.zoom,
    'media_id':30,
    'template_id':19,
    'position':$scope.positionE
  };
  $http.post('../php/product.php',datos)
  .success(function(data){
    getCountries();
    console.log(data);
  }).error(function(response){
    alert("No se obtuvieron los Product");
  });
// $country_id,$language_id,$name,$description
for (var i = 0; i <  $scope.languages.length; i++) {
   var datos={
    'action':17,
    'product_id':$scope.idEdit,
    'language_id':$scope.languages[i].id,
    'name':$("#nameP-"+$scope.languages[i].id).val(),
    'description':$("#descriptionP-"+$scope.languages[i].id).val()
  };
  $http.post('../php/product.php',datos)
  .success(function(data){
    getProduct();
    console.log(data);
  }).error(function(response){
    alert("No se obtuvieron los Product");
  });
}//end to for

}// end to update country


});
