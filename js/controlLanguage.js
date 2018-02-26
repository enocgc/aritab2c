appRouter.controller('controlLanguage',function($scope,$http,$timeout){
  //$scope.estado=true;
  getLanguage();
 $scope.languages;
  function getLanguage(){
    var action=3;
   $http.post('../php/language.php', {'action':action})
   .success(function(data){
    $scope.languages = data;

     // alert("get exitoso");
   }).error(function(response){

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
        $.toast({
        heading: 'Success',
        text: 'Add Language.',
        showHideTransition: 'slide',
        icon: 'success'
      });
      }).error(function(response){
        $.toast({
          heading: 'Error',
          text: 'Add Language.',
          showHideTransition: 'fade',
          icon: 'error'
      });
      });
  }//fin funcion Language

  //funcion getLanguagetoModal
  $scope.getLanguagetoModal = function(id){
    var action=6;
   $http.post('../php/language.php', {'action':action,'id':id})
   .success(function(data){
     $scope.languagesE = data;
     //console.log(data);
     $scope.idE=data[0].id;
     $scope.nameE=data[0].name;
     $scope.shortE=data[0].short;
     $scope.iconE=data[0].icon;
     // alert("get exitoso");
   }).error(function(response){
    // console.log("No se get el usuario");
   });

  }

  //funcion editLanguage
  $scope.editLanguage = function(){
        var action=4;
      $http.post('../php/language.php', {'action':action,'idE':$scope.idE,'nameE': $scope.nameE,'shortE': $scope.shortE,
      'iconE': $scope.iconE})
      .success(function(data){
        //  $("#edit-user").hide();
        getLanguage();
        $.toast({
        heading: 'Success',
        text: 'Update Language.',
        showHideTransition: 'slide',
        icon: 'success'
      });
      }).error(function(response){
        $.toast({
          heading: 'Error',
          text: 'Not Update Language',
          showHideTransition: 'fade',
          icon: 'error'
      });
      });
  }
  //funcion para cambiar el estado
  $scope.changeenabled = function(id,enabled){
  //  console.log(id+" id estado "+enabled);
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

      $.toast({
      heading: 'Success',
      text: 'Change state.',
      showHideTransition: 'slide',
      icon: 'success'
    });
    }).error(function(response){
      $.toast({
        heading: 'Error',
        text: 'Not Change state.',
        showHideTransition: 'fade',
        icon: 'error'
    });
    });
  }
  //funcion para eliminar por id
  $scope.deleteLanguage = function(id){
    var action=2;
    console.log(action);
    $("#confirmdelete").click(function(){
      $http.post("../php/language.php",{'action':action,'id':id})
      .success(function(data){
        $.toast({
          heading: 'Success',
          text: 'Delete Language.',
          showHideTransition: 'fade',
          icon: 'error'
      });
        getLanguage();
      });
    });

  }

});
