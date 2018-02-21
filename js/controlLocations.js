appRouter.controller('controlLocations',function($scope,$http,$timeout){
$scope.locations;
$scope.languages;
$scope.countries;

getLocations();
getLanguage();
// Set by default the value "test1"
$scope.units = [
         {'id': 19, 'label': '200x100'},
         {'id': 21, 'label': '800x600'},
      ];

$scope.data= $scope.units[1]; // Set by default the value "test1"
function getLocations(){
  console.log("locations");
  var action=1;
  $http.post('../php/locations.php', {'action':action})
  .success(function(data){
    console.log(data);
    $scope.locations = data;
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
     console.log($scope.languages);
      // alert("get exitoso");
    }).error(function(response){
      alert("No se get el Language");
    });
  }

$scope.changeenabled=function(id,enabled){
  console.log(id+"estado actual "+enabled);
  var estado;
  if(enabled==0){
     estado=1;
  }else{
     estado=0;
  }
  var action=2;
  $http.post('../php/locations.php', {'action':action,'id':id,'enabled':estado})
  .success(function(data){
    console.log(data);
    getLocations();
  }).error(function(response){
    console.log("No se actualizo el el estado");
  });
}//fin funcioncambiar estado

//process to delete
$scope.itemToDelete;
$scope.deleteLocation=function(id){ $scope.itemToDelete=id;}// end to delte country details
$scope.confirmdelete=function(){
  alert($scope.itemToDelete);
  var action=8;
  $http.post('../php/locations.php', {'action':action,'id':$scope.itemToDelete})
  .success(function(data){
    alert(data);
    console.log(data);
    getLocations();
  }).error(function(response){
    alert("No se obtuvieron los countries");
  });
}//end to confirmdelete
$scope.idEdit;
$scope.getEditLocation=function(id){
  $scope.idEdit=id;
  var datos={
    'action':3,
    'id':id
  };
  $http.post('../php/locations.php',datos)
  .success(function(data){
    $scope.countrymap = data;
    console.log(data);
    createMarker(data[0].gpslat,data[0].gpslong,data[0].gpszoom);
    $scope.latitude=data[0].gpslat;
    $scope.longitude=data[0].gpslong;
    $scope.zoom=data[0].gpszoom;
    console.log($scope.countrieslist);
    for(var i=0;i<$scope.countrieslist.length;i++){
    console.log($scope.countrieslist[i].country_id);
    var idvalue=$scope.countrieslist[i].country_id;
      if(idvalue==data[0].bcountry_id){
        console.log("el id seleccionado es "+i);
        $scope.dataCountrySelect= $scope.countrieslist[i];
      }
    }//end to for
  }).error(function(response){
    alert("No se obtuvieron los countries");
  });
  // language
  datos={
    'action':4,
    'id':id
  };
  $http.post('../php/locations.php',datos)
  .success(function(data){
    for(var i=0;i<data.length;i++){
      $("#nameE-"+data[i].language_id).val(data[i].name);
      $("#descriptionE-"+data[i].language_id).val(data[i].description);
    }
  }).error(function(response){
    alert("No se obtuvieron los countries");
  });

  datos={
    'action':5,
    'id':id
  };
  $http.post('../php/locations.php',datos)
  .success(function(data){
    if(data==-1){
      alert("No se encontrarion resultados para el media");
      $scope.position=0;
    }else{
    console.log(data);
    $scope.position=data[0].position;
    }
  }).error(function(response){
    alert("No se obtuvieron los countries");
  });
}//end to getEditLocation

$scope.updateLocation= function(){
   var datos={
    'action':6,
    'id':$scope.idEdit,
    'gpslat':$scope.latitude,
    'gpslong':$scope.longitude,
    'gpszoom':$scope.zoom,
    'media_id':30,
    'template_id':19,
    'position':$scope.position,
    'country_id':$scope.dataCountrySelect.country_id
  };
  $http.post('../php/locations.php',datos)
  .success(function(data){
    getLocations();
    console.log(data);
  }).error(function(response){
    alert("No se obtuvieron los countries");
  });
// $country_id,$language_id,$name,$description
for (var i = 0; i <  $scope.languages.length; i++) {
   var datos={
    'action':7,
    'location_id':$scope.idEdit,
    'language_id':$scope.languages[i].id,
    'name':$("#nameE-"+$scope.languages[i].id).val(),
    'description':$("#descriptionE-"+$scope.languages[i].id).val()
  };
  $http.post('../php/locations.php',datos)
  .success(function(data){
    console.log(data);
  }).error(function(response){
    alert("No se obtuvieron los countries");
  });
}//end to for
getLocations();
}//end to updateLocation


$scope.countrieslist=[];
getCountries();
function getCountries (){
  $http.post('../php/locations.php',{'action':9})
  .success(function(data){
    $scope.countrieslist=data;
    $scope.dataCountrySelect= $scope.countrieslist[0];
  }).error(function(response){
    alert("No se obtuvieron los countries");
  });
}//end to getCountries

$scope.addLocation=function(){
  var datos={
    'action':10,
    'country_id':$scope.dataCountrySelect.country_id,
    'gpslat':$scope.latitude,
    'gpslong':$scope.longitude,
    'gpszoom':$scope.zoom,
    'media_id':1,
    'template_id':1,
    'position':$scope.position
  };
  $http.post('../php/locations.php',datos)
  .success(function(data){
    console.log(data);
    // location_id,language_id,name,description,enabled
      for (var i = 0; i <  $scope.languages.length; i++) {
           var datos={
            'action':11,
            'location_id':data[0].location_id,
            'language_id':$scope.languages[i].id,
            'name':$("#nameE-"+$scope.languages[i].id).val(),
            'description':$("#descriptionE-"+$scope.languages[i].id).val()
          };
          $http.post('../php/locations.php',datos)
          .success(function(data){
            console.log(data);
            if(data==1){
              alert("agregado exitoso");
            }
          }).error(function(response){
            alert("No se pudo agregar los details, error de servidor");
          });
      }//end to for
    console.log(data);
  }).error(function(response){
    alert("No se obtuvieron los countries");
  });
}//end o addLocation

});// FIN  del controlador
