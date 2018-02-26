//cree los controladores
appRouter.controller('controlService',function($scope,$http,$timeout){
  console.log("tags run");
  getService();
  getLanguage();
  $scope.services;
  function getService(){
    var action=1;
    //  console.log(action);
    $http.post('../php/service.php', {'action':action})
    .success(function(data){
      $scope.services = data;
      //console.log(data);
      console.log("get service");

    }).error(function(response){
      console.log("No se get  tags");
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
      //  console.log($scope.languages);
      // alert("get exitoso");
    }).error(function(response){
      console.log("No se get el Language");
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
          console.log("No iserto service detail");
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
      console.log("No iserto service");
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
        console.log("No se get el tags");
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

//funcion para eliminar por id
$scope.deleteService = function(id){
//console.log("id  "+id);
var action=8;
console.log(action);
$("#confirmdelete").click(function(){
$http.post("../php/service.php",{'action':action,'id':id})
.success(function(data){
  console.log(data);
setTimeout(function () {//para que actualice los campos de forma eficiente
$scope.$apply(function () {

if(data=1){
getService();
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
