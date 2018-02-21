//cree los controladores
appRouter.controller('controlPaxOcupation',function($scope,$http,$timeout){

  getPaxOcupation();
getOcupation();
$scope.paxs;
  function getPaxOcupation(){
    var action=1;
    //  console.log(action);
    $http.post('../php/paxocupation.php', {'action':action})
    .success(function(data){
      $scope.paxs = data;
      console.log(data);
      //  console.log($scope.seasons);
      // alert("get exitoso");
    }).error(function(response){
      alert("No se get  tax");
    });
  }

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


//funcion para agregar detalles
  $scope.addpax = function(){
    var action=3;
    console.log($scope.selectedOcupation.id);
    $http.post('../php/paxocupation.php', {'action':action,'pax':$scope.pax,'occupation_id':$scope.selectedOcupation.id})//creo el tag
    .success(function(data){
      $scope.newPaxs = data;

      setTimeout(function () {//para que actualice los campos de forma eficiente
          $scope.$apply(function () {
            getPaxOcupation();
            console.log("se agrego nuevo pax");
          });
      }, 100);

      // alert("get exitoso");
    }).error(function(response){
      alert("No iserto tag");
    });
}

//funcion para mostrar datos en getLanguagetoModal
$scope.ocupations2=[];

$scope.getPaxOcupationtoModal=function(id){
function find(produ) {
  return produ.id === id;
}
$scope.paxE= parseInt($scope.paxs.find(find).pax);
var ocupation=($scope.paxs.find(find).occupation_id);
for(var i=0;i<$scope.ocupations.length;i++){
console.log(i);
console.log($scope.ocupations[i].id+"/"+ocupation);

if ($scope.ocupations[i].id == ocupation ) {
  console.log(ocupation+" la posicion 1 es "+$scope.ocupations[i].id);
  $scope.ocupations2[i]=$scope.ocupations[i];
}

}//end to for
console.log($scope.ocupations2);
}/*
$scope.editPaxOcupation =function(){
  var action=6;
  //console.log('edit'+langid);
  $scope.contador=0;
  for (var i = 0; i <  $lang.length; i++) {
  //  console.log("entro "+i+$scope.languages[i].short);
    var name= document.getElementById('nameE-'+$scope.languages[i].short).value;
    var description= document.getElementById('descriptionE-'+$scope.languages[i].short).value;
    var langid = $scope.languages[i].id;
  $http.post('../php/tags.php', {'action':action,'id':$scope.idTagE,'language_id':langid,'name':name,'description':description})
  .success(function(data){
    console.log(data);
    getTags();
    console.log("actulizado exitosamente ");
    if($lang.length==$scope.contador+1){
      getLanguage()
        console.log("guardado exitosamente");
    }
    $scope.contador++;
  }).error(function(response){
    console.log("No se actualizo ");
  });
}
}//fin funcon edit*/
//funcion para cambiar el estado
$scope.changeenabled = function(id,enabled){
  console.log("estado actual "+enabled);
  var estado;
  if(enabled==0){
     estado=1;
  }else{
     estado=0;
  }
  var action=7;
  $http.post('../php/paxocupation.php', {'action':action,'id':id,'enabled':estado})
  .success(function(data){
    console.log(data);
    getPaxOcupation();
    console.log("actulizado exitosamente el estado");
  }).error(function(response){
    console.log("No se actualizo el el estado");
  });
}//fin funcioncambiar estado

//funcion para eliminar por id
$scope.deletePax = function(id){
  var action=8;
  console.log(action+"id"+id);
  $("#confirmdelete").click(function(){
    $http.post("../php/paxocupation.php",{'action':action,'id':id})
    .success(function(data){
      setTimeout(function () {//para que actualice los campos de forma eficiente
          $scope.$apply(function () {
            if(data=1){
              getPaxOcupation();
              console.log("se elimino exitosamente ");
            }else{
                    console.log("Presento un error al eliminar ");
            }

          });
      }, 300);
      //console.log("id season:  "+id);
    });
  });
}


});
