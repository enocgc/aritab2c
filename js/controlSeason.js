appRouter.controller('controlSeason',function($scope,$http,$timeout){
  //$scope.estado=true;
  getSeason();
  getYears();
  $scope.seasons;

  function getSeason(){
    var action=3;
  //  console.log(action);
    $http.post('../php/season.php', {'action':action})
    .success(function(data){
      $scope.seasons = data;

    //  console.log($scope.seasons);
      // alert("get exitoso");
    }).error(function(response){
      alert("No se get el Season");
    });
  }
  $scope.years;

  function getYears(){
    var action=7;
  //  console.log(action);
    $http.post('../php/season.php', {'action':action})
    .success(function(data){
      setTimeout(function () {//para que actualice los campos de forma eficiente
          $scope.$apply(function () {
            $scope.years = data;
            //console.log(data);
          });
      }, 300);

    //  console.log($scope.years);
      // alert("get exitoso");
        getSeason();
    }).error(function(response){
      alert("No se get el Season");
    });
  }

  //FUNCION AGREGAR Language
  $scope.addSeason = function() {

    var action=1;
  //  console.log(action);
    $http.post('../php/season.php', {'action':action,'name': $scope.name})
    .success(function(data){
      getSeason();
        getYears();
      alert("Insertado exitosamente");
    }).error(function(response){
      alert("No se agrego el usuario");
    });
  }//fin funcion Language
  $scope.addSeasonPeriods = function() {
  //  console.log($scope.selectedYear.name+" "+$scope.selectedYear.id+" "+$scope.startdate+" "+$scope.enddate);
    var action=8;
  //  console.log(action);
    $http.post('../php/season.php', {'action':action,'id':$scope.selectedYear.id,'startdate':$scope.startdate,'enddate':$scope.enddate})
    .success(function(data){
      $scope.startdate="";
      $scope.enddate="";
      $scope.selectedYear.name="";
      getSeason();
      alert("Insertado exitosamente");
    }).error(function(response){
      alert("No se agrego el usuario");
    });
  }//fin funcion Language

  //funcion getLanguagetoModal
  $scope.getSeasontoModal = function(id,id2){
    var action=6;
  //  console.log("id season: "+id+" id periods: "+id2);
  //  console.log(action);
    $http.post('../php/season.php', {'action':action,'id':id,'id2':id2})
    .success(function(data){
      $scope.seasonsE = data;
      //console.log(data);
      // $scope.idE=data[0].id;
  //    console.log("edit");
      $scope.nameE=data[0].name;
      $scope.startdateE=data[0].startdate;
      $scope.enddateE=data[0].enddate;
      $scope.idE=data[0].id;
//console.log($scope.seasonsE);
      // alert("get exitoso");
    }).error(function(response){
      alert("No se get el usuario");
    });

  }

  //funcion editLanguage
  $scope.editSeason = function(){
    var action=4;
    $http.post('../php/season.php', {'action':action,'idE':$scope.idE,'startdateE': $scope.startdateE,'enddateE': $scope.enddateE})
    .success(function(data){
      //  $("#edit-user").hide();
      console.log("id "+$scope.idE+"start: "+ $scope.startdateE+"end: "+$scope.enddateE);
      getSeason();
      alert("actulizado exitosamente season");
    }).error(function(response){
      alert("No se actualizo el season");
    });
  }

  //funcion para eliminar por id
  $scope.deleteSeason = function(id){
      console.log("id season:  "+id);
    var action=2;
    console.log(action);
    $("#confirmdelete").click(function(){
      $http.post("../php/season.php",{'action':action,'id':id})
      .success(function(data){
        //console.log("id season:  "+id);
        console.log("se elimino exitosamente "+id);
        getSeason();
          getYears();
      });
    });

  }

});
