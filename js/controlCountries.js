appRouter.controller('controlCountries',function($scope,$http,$timeout){
$scope.countries;
$scope.languages;

getCountries();
getLanguage();

$scope.units = [
         {'id': 19, 'label': '200x100'},
         {'id': 21, 'label': '800x600'},
      ];

$scope.data= $scope.units[0]; // Set by default the value "test1"
//funcion para agregar detalles
  $scope.addCountry = function($lang){
    alert($scope.data.label);
    alert($scope.position);
    alert($scope.latitude);
    alert($scope.longitude);
    alert($scope.zoom);
    var action=4;
    var data={
        'action':action,
        'gpslat':$scope.latitude,
        'gpslong':$scope.longitude,
        'gpszoom':$scope.zoom
      };
    $http.post('../php/countries.php',data)//creo el tag
    .success(function(data){
      $scope.newTag = data;
      for (var i = 0; i <  $lang.length; i++) {
        console.log("entro "+i+$scope.languages[i].short);
        var name= document.getElementById('name-'+$scope.languages[i].short).value;
        var description= document.getElementById('description-'+$scope.languages[i].short).value;
        var langid = $scope.languages[i].id;
        var datos={
          'action':5,
          'country_id':$scope.newTag[0].id,
          'language_id':langid,
          'name':name,
          'description':description
        };
        console.log("agregando en id "+$scope.newTag[0].id);
        $http.post('../php/countries.php',datos)//creo el tag
        .success(function(data){
          console.log("se agrego el country details correctamente"+data);
        }).error(function(response){
          alert("No agrego el countrie details");
        });
      }//fin del for

      // $country_id,$media_id,$template_id,$position
      var datos={
          'action':6,
          'country_id':$scope.newTag[0].id,
          'media_id':777,
          'template_id':$scope.data.id,
          'position':$scope.position
        };
        $http.post('../php/countries.php',datos)//creo el tag
        .success(function(data){
          console.log("se agrego el country media correctamente"+data);
        }).error(function(response){
          alert("No agrego el country media");
        });

      setTimeout(function () {//para que actualice los campos de forma eficiente
          $scope.$apply(function () {
            // getTags();
            console.log("final");
          });
      }, 100);

      // alert("get exitoso");
    }).error(function(response){
      alert("No iserto tag");
    });
}


function getCountries(){
  var action=1;
  $http.post('../php/countries.php', {'action':action})
  .success(function(data){
    $scope.countries = data;
    console.log(data);
    console.log("peticion finalizada datos arriba para renderizar");
  }).error(function(response){
    alert("No se obtuvieron los countries");
  });
}

function getLanguage(){
  var action=2;
  //console.log(action);
  $http.post('../php/tags.php', {'action':action})
  .success(function(data){
    $scope.languages = data;
  //  console.log($scope.languages);
    // alert("get exitoso");
  }).error(function(response){
    alert("No se get el Language");
  });
}

$scope.changeenabled=function(language_id,enabled){
  console.log("estado actual "+enabled);
  var estado;
  if(enabled==0){
     estado=1;
  }else{
     estado=0;
  }
  var action=2;
  $http.post('../php/countries.php', {'action':action,'language_id':language_id,'enabled':estado})
  .success(function(data){
    console.log(data);
    getCountries();
  }).error(function(response){
    console.log("No se actualizo el el estado");
  });
}//fin funcioncambiar estado

//process to delete
$scope.itemToDelete;
$scope.deleteCountryDetails=function(id){ $scope.itemToDelete=id;}// end to delte country details
$scope.confirmdelete=function(){
  var action=3;
  $http.post('../php/countries.php', {'action':action,'language_id':$scope.itemToDelete})
  .success(function(data){
    $scope.countries = data;
    getCountries();
  }).error(function(response){
    alert("No se obtuvieron los countries");
  });
}
});// FIN  del controlador
