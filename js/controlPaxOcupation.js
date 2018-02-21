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
      //console.log(data);
console.log(" get  tax");
    }).error(function(response){
        console.log("No se get  tax");
    });
  }

  function getOcupation(){
    var action=1;
    //  console.log(action);
    $http.post('../php/ocupation.php', {'action':action})
    .success(function(data){
      $scope.ocupations = data;
      console.log("get service");
    }).error(function(response){
      console.log("No se get  tags");
    });
  }


//funcion para agregar detalles
  $scope.addpax = function(){
    var action=3;
    console.log($scope.selectedOcupation.id);
    $http.post('../php/paxocupation.php', {'action':action,'pax':$scope.pax,'occupation_id':$scope.selectedOcupation.id})//creo el tag
    .success(function(data){
      $scope.newPaxs = data;
      $.toast({
      heading: 'Success',
      text: 'Add Pax Ocupation.',
      showHideTransition: 'slide',
      icon: 'success'
    });
      setTimeout(function () {//para que actualice los campos de forma eficiente
          $scope.$apply(function () {
            getPaxOcupation();
          });
      }, 100);

    }).error(function(response){
      $.toast({
        heading: 'Error',
        text: 'Not Add Pax Ocupation.',
        showHideTransition: 'fade',
        icon: 'error'
    });
    });
}

//funcion para mostrar datos en getLanguagetoModal

$scope.getPaxOcupationtoModal=function(id){
$scope.idpaxE=id;
function find(produ) {
  return produ.id === id;
}
$scope.paxE= parseInt($scope.paxs.find(find).pax);

var ocupation=($scope.paxs.find(find).occupation_id);//

for(var i=0;i<$scope.ocupations.length;i++){
console.log(i);
console.log($scope.ocupations[i].id+"/"+ocupation);
if ($scope.ocupations[i].id == ocupation ) {
  console.log(ocupation+" la posicion 1 es "+$scope.ocupations[i].id);
  $scope.selectedOcupationE=$scope.ocupations[i];
}
}//end to for

}

$scope.editpax =function(){
  var action=6;
console.log($scope.idpaxE);
$http.post('../php/paxocupation.php', {'action':action,'id':$scope.idpaxE,'pax':$scope.paxE,'occupation_id':$scope.selectedOcupationE.id})//creo el tag
.success(function(data){
console.log(data);

  $.toast({
  heading: 'Success',
  text: 'Update Pax Ocupation.',
  showHideTransition: 'slide',
  icon: 'success'
});
  setTimeout(function () {//para que actualice los campos de forma eficiente
      $scope.$apply(function () {
        getPaxOcupation();
      });
  }, 100);

}).error(function(response){
  $.toast({
    heading: 'Error',
    text: 'Not Add Pax Ocupation.',
    showHideTransition: 'fade',
    icon: 'error'
});
});

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
$scope.deletePax = function(id){
  var action=8;
  console.log(action+"id"+id);
  $("#confirmdelete").click(function(){
    $http.post("../php/paxocupation.php",{'action':action,'id':id})
    .success(function(data){
      $.toast({
        heading: 'Error',
        text: 'Delete Pax Ocupation.',
        showHideTransition: 'fade',
        icon: 'error'
  });
      setTimeout(function () {//para que actualice los campos de forma eficiente
          $scope.$apply(function () {
            if(data=1){
              getPaxOcupation();

            }else{

            }

          });
      }, 300);
      //console.log("id season:  "+id);
    });
  });
}


});
