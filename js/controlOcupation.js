//cree los controladores
appRouter.controller('controlOcupation',function($scope,$http,$timeout){
  console.log("tags run");
  getOcupation();
  getLanguage();
  $scope.ocupations;
  function getOcupation(){
    var action=1;
    //  console.log(action);
    $http.post('../php/ocupation.php', {'action':action})
    .success(function(data){
      $scope.ocupations = data;
      console.log(data);
      //console.log(data);
      console.log("get service");


      //  console.log($scope.seasons);
      // alert("get exitoso");
    }).error(function(response){
      alert("No se get  tags");
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
      alert("No se get el Language");
    });
  }
  //funcion para agregar detalles
  $scope.addOcupation = function($lang){
    var action=3;
    console.log($scope.id+$scope.persons);
    $http.post('../php/ocupation.php', {'action':action,'id':$scope.id,'persons':$scope.persons})//creo el ocupation
    .success(function(data){
      //crear funcion para anadir detalle por idioma el siclo me jala los datos y podemos mandar el id del idioma como parametro
      for (var i = 0; i <  $lang.length; i++) {
      //  console.log("entro "+i+$scope.languages[i].short);
      var description = document.getElementById('description'+$scope.languages[i].short).value;
      console.log($scope.languages[i].short);
        var langid = $scope.languages[i].id;
        $http.post('../php/ocupation.php', {'action':4,'id': $scope.id,'language_id':langid,'description':description})
        .success(function(data){
          console.log(data);
          console.log("se agrego ocupation detail correctamente");
        }).error(function(response){
          alert("No iserto ocupation detail");
        });
      }//fin del for
      setTimeout(function () {//para que actualice los campos de forma eficiente
        $scope.$apply(function () {
          getOcupation();
          console.log("se agrego nuevo Ocupation");
        });
      }, 200);

      // alert("get exitoso");
    }).error(function(response){
      alert("No iserto ocupation");
    });
  }

  //funcion para mostrar datos en getLanguagetoModal
  $scope.getOcupationtoModal=function(lang,id,persons){
    //$scope.typeS
    getLanguage();
    $scope.idE=id;
    $("#personsE").val(persons);
  //  $scope.persons=persons;
    var action=5;
    console.log(action);
    $scope.contador=0;
    $scope.vector=[];
  getOcupation();
    for (var i = 0; i <  lang.length; i++) {
      var langid = $scope.languages[i].id;
      var short = $scope.languages[i].short;
      //console.log($scope.languages[i].short);
      $http.post('../php/ocupation.php', {'action':action,'id':id,'idlan':langid,'short':short})
      .success(function(data){
        //$scope.ocupationE = data;
        console.log("Datos");
        console.log(data);
        var cont=$scope.contador;
        setTimeout(function () {//para que actualice los campos de forma eficiente
            $scope.$apply(function () {
                 console.log(data[0].description);
                 $("#descriptionE-"+data[0].short).val(data[0].description);
                //  $("#descriptionE-"+data[0].short).val(data[0].description);
              });
            }, 200);
        //usamos el contador para saber si todas las peticiones se hiceron
        console.log("vector"+$scope.contador+" lang "+lang.length);
        $scope.contador=$scope.contador+1;
      }).error(function(response){
        alert("No se get el tags");
      });

    }
}
$scope.editOcupation =function($lang){
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
$scope.deleteOcupation = function(id){
//console.log("id  "+id);
var action=8;
console.log(action);
$("#confirmdelete").click(function(){
$http.post("../php/service.php",{'action':action,'id':id})
.success(function(data){
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
