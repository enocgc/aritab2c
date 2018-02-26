appRouter.controller('controlUser',function($scope,$http,$timeout){
  //$scope.estado=true;
  getUser();
 $scope.users;
  function getUser(){
    var action=3;
    console.log(action);
   $http.post('../php/users.php', {'action':action})
   .success(function(data){
    $scope.users = data;
     // alert("get exitoso");
   }).error(function(response){
     console.log("No se get el usuario");
   });
  }


  //FUNCION AGREGAR USUARIO
  $scope.addUser = function() {
    if($scope.password == $scope.repassword){
      console.log("password y repasswor iguales");
      var action=1;
       console.log(action);
      $http.post('../php/users.php', {'action':action,'name': $scope.name,'user': $scope.user,
      'password': $scope.password,'email': $scope.email,'phone': $scope.phone,'country': $scope.country,'company': $scope.company})
      .success(function(data){
        if (data == 1) {
          getUser();
          $scope.name="";
          $scope.user="";
          $scope.password="";
          $scope.repassword="";
          $scope.email="";
          $scope.phone="";
          $scope.country="";
          $scope.company="";
          $.toast({
          heading: 'Success',
          text: 'Add User.',
          showHideTransition: 'slide',
          icon: 'success'
        });
        }else{
          $scope.name="";
          $scope.user="";
          $scope.password="";
          $scope.repassword="";
          $scope.email="";
          $scope.phone="";
          $scope.country="";
          $scope.company="";
          $.toast({
            heading: 'Error',
            text: 'User already exist.',
            showHideTransition: 'fade',
            icon: 'error'
        });
        }
      }).error(function(response){
        $.toast({
          heading: 'Error',
          text: 'Not add user.',
          showHideTransition: 'fade',
          icon: 'error'
      });
      });

    }else{
      console.log("password y repasword diferentes");
    }
  }//fin funcion AGREGAR
  //funcion
  $scope.getUsertoModal = function(iduser){
    var action=6;
    console.log(action);
   $http.post('../php/users.php', {'action':action,'iduser':iduser})
   .success(function(data){
     $scope.usersE = data;
     //console.log(data);
     $scope.idUserE=data[0].iduser;
     $scope.nameE=data[0].name;
     $scope.userE=data[0].user;
     $scope.passwordE="";
     $scope.repasswordE="";
     $scope.emailE=data[0].email;
     $scope.phoneE=data[0].phone;
     $scope.countryE=data[0].country;
     $scope.companyE=data[0].company;
     // alert("get exitoso");
   }).error(function(response){
     console.log("error to load data in modal");
   });

  }
  //funcion editar
  $scope.editUser = function(){

        var action=4;
      $http.post('../php/users.php', {'action':action,'iduserE':$scope.idUserE,'nameE': $scope.nameE,'userE': $scope.userE,
      'passwordE': $scope.passwordE,'emailE': $scope.emailE,'phoneE': $scope.phoneE,'countryE': $scope.countryE,'companyE': $scope.companyE})
      .success(function(data){
        //  $("#edit-user").hide();
        getUser();
        $.toast({
        heading: 'Success',
        text: 'Update User.',
        showHideTransition: 'slide',
        icon: 'success'
      });
      }).error(function(response){
        $.toast({
          heading: 'Error',
          text: 'Update User.',
          showHideTransition: 'fade',
          icon: 'error'
      });
      });
  }
  //funcion para actualizar el password
  $scope.editPassword = function(){
    if ($scope.newPass == $scope.reNewPass) {
      var action=7;
      //console.log($scope.idUserE+$scope.actualPass+ $scope.newPass+$scope.reNewPass);
      $http.post('../php/users.php', {'action':action,'idUserE':$scope.idUserE,'actualPass':$scope.actualPass,'newPass':$scope.newPass})
      .success(function(data){
        if (data==1) {
        $scope.actualPass="";
        $scope.newPass="";
        $scope.reNewPass="";
        getUser();
        $.toast({
        heading: 'Success',
        text: 'Update Password.',
        showHideTransition: 'slide',
        icon: 'success'
      });

    }else{
      $scope.actualPass="";
      $scope.newPass="";
      $scope.reNewPass="";
      $.toast({
        heading: 'Error',
        text: 'Password not exist.',
        showHideTransition: 'fade',
        icon: 'error'
    });
    }

      }).error(function(response){
        console.log("No se actualizo el usuario");
      });
    }else{
      $.toast({
        heading: 'Error',
        text: 'Update password.',
        showHideTransition: 'fade',
        icon: 'error'
    });
    }

  }
  //funcion para cambiar el estado
  $scope.changeenabled = function(iduser,enabled){
    console.log(iduser+" "+enabled);
    if(enabled==0){
      var estado=1;
    }else{
      var estado=0;
    }
    var action=5;
    $http.post('../php/users.php', {'action':action,'iduserF':iduser,'enabledF':estado})
    .success(function(data){
      console.log(estado);
      getUser();
      $.toast({
      heading: 'Success',
      text: 'Update state.',
      showHideTransition: 'slide',
      icon: 'success'
    });
    }).error(function(response){
      $.toast({
        heading: 'Error',
        text: 'Not change state.',
        showHideTransition: 'fade',
        icon: 'error'
    });
    });
  }
  //funcion para eliminar por id
  $scope.deleteUser = function(iduser){
    var action=2;
    console.log(action);
    $("#confirmdelete").click(function(){
      $http.post("../php/users.php",{'action':action,'iduser':iduser})
      .success(function(data){
        $.toast({
          heading: 'Succes',
          text: 'Delete User.',
          showHideTransition: 'fade',
          icon: 'error'
      });
        getUser();
      });
    });

  }

});
