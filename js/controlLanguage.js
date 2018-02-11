appRouter.controller('controlLanguage',function($scope,$http,$timeout){
  //$scope.estado=true;
  getLanguage();
 $scope.languages;
  function getLanguage(){
    var action=3;
    console.log(action);
   $http.post('../php/language.php', {'action':action})
   .success(function(data){
    $scope.languages = data;
     console.log($scope.languages);
     // alert("get exitoso");
   }).error(function(response){
     alert("No se get el Language");
   });
  }


  //FUNCION AGREGAR Language
  $scope.addLanguage = function() {

      var action=1;
       console.log(action);
      $http.post('../php/language.php', {'action':action,'name': $scope.name,'short': $scope.short,
      'icon': $scope.icon})
      .success(function(data){
        getLanguage();
        $scope.name="";
        $scope.short="";
        $scope.icon="";
        alert("Insertado exitosamente");
      }).error(function(response){
        alert("No se agrego el usuario");
      });
  }//fin funcion Language

  //funcion getLanguagetoModal
  $scope.getLanguagetoModal = function(id){
    var action=6;
    console.log(action);
   $http.post('../php/language.php', {'action':action,'id':id})
   .success(function(data){
     $scope.languagesE = data;
     //console.log(data);
     $scope.idE=data[0].id;
     $scope.nameE=data[0].name;
     $scope.shortE=data[0].short;
     $scope.iconE=data[0].icon;
     console.log($scope.languagesE);
     // alert("get exitoso");
   }).error(function(response){
     alert("No se get el usuario");
   });

  }

  //funcion editLanguage
  $scope.editLanguage = function(){
        var action=4;
      $http.post('../php/language.php', {'action':action,'idE':$scope.idE,'nameE': $scope.nameE,'shortE': $scope.shortE,
      'iconE': $scope.iconE})
      .success(function(data){
        //  $("#edit-user").hide();
        console.log($scope.idE+$scope.nameE+$scope.shortE+$scope.iconE);
        getLanguage();
        alert("actulizado exitosamente language");
      }).error(function(response){
        alert("No se actualizo el language");
      });
  }
  //funcion para cambiar el estado
  $scope.changeenabled = function(id,enabled){
    console.log(id+" id estado "+enabled);
    if(enabled==0){
      var estado=1;
    }else{
      var estado=0;
    }
    var action=5;
    $http.post('../php/language.php', {'action':action,'idF':id,'enabledF':estado})
    .success(function(data){
      setTimeout(function () {//para que actualice los campos de forma eficiente
          $scope.$apply(function () {
            //console.log(estado);
            getLanguage();
          });
      }, 300);

      console.log("actulizado exitosamente el estado");
    }).error(function(response){
      console.log("No se actualizo el el estado");
    });
  }
  //funcion para eliminar por id
  $scope.deleteLanguage = function(id){
    var action=2;
    console.log(action);
    $("#confirmdelete").click(function(){
      $http.post("../php/language.php",{'action':action,'id':id})
      .success(function(data){
        console.log("se elimino exitosamene");
        getLanguage();
      });
    });

  }

});
