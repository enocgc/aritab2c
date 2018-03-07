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
    }).error(function(response){
        console.log("No se get el Season");
    });
  }

  $scope.getyear=function(){
    var year = (new Date()).getFullYear();
  $scope.name=year;
    $("#year2").attr('value',year);
  }
  $scope.years;

  function getYears(){
    var action=7;
    $http.post('../php/season.php', {'action':action})
    .success(function(data){
      setTimeout(function () {//para que actualice los campos de forma eficiente
          $scope.$apply(function () {
            $scope.years = data;
          });
      }, 300);

        getSeason();
    }).error(function(response){
        console.log("No se get el Season");
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
        $.toast({
        heading: 'Success',
        text: 'Add Year.',
        showHideTransition: 'slide',
        icon: 'success'
      });
    }).error(function(response){
      $.toast({
        heading: 'Error',
        text: 'Not Add Year.',
        showHideTransition: 'fade',
        icon: 'error'
    });
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
      $.toast({
      heading: 'Success',
      text: 'Add Season.',
      showHideTransition: 'slide',
      icon: 'success'
    });
    }).error(function(response){
      $.toast({
        heading: 'Error',
        text: 'Not Add Season.',
        showHideTransition: 'fade',
        icon: 'error'
    });
    });
  }//fin funcion Language

  //funcion getLanguagetoModal
  $scope.getSeasontoModal = function(id,id2){
    var action=6;
    console.log(id);
    $scope.idSeasonE=id2;
  //  console.log("id season: "+id+" id periods: "+id2);
  //  console.log(action);
    $http.post('../php/season.php', {'action':action,'id':id,'id2':id2})
    .success(function(data){
      $scope.seasonsE = data;

      function find(produ) {
        return produ.id === id;
      }
      var year= parseInt($scope.years.find(find).name);
      for (var i = 0; i < $scope.years.length; i++) {

        if ($scope.years[i].name == year ) {
            $scope.selectedYearE=$scope.years[i];
        }
      }

      $scope.nameE=data[0].name;
      $scope.startdateE=data[0].startdate;
      $scope.enddateE=data[0].enddate;
      $scope.idE=data[0].id;
    }).error(function(response){
        console.log("No se get el usuario");
    });

  }

  //funcion editLanguage
  $scope.editSeason = function(){
    var action=4;
    $http.post('../php/season.php', {'action':action,'idE':$scope.idSeasonE,'season_id':$scope.selectedYearE.id,'startdateE': $scope.startdateE,'enddateE': $scope.enddateE})
    .success(function(data){
      console.log(data);
      //  $("#edit-user").hide();
      getSeason();
      $.toast({
      heading: 'Success',
      text: 'Edit Season.',
      showHideTransition: 'slide',
      icon: 'success'
    });
    }).error(function(response){
      $.toast({
        heading: 'Error',
        text: 'Not Update season.',
        showHideTransition: 'fade',
        icon: 'error'
    });
    });
  }

  //funcion para eliminar por id
  $scope.deleteSeason = function(id){
    var action=2;
    $("#confirmdelete").click(function(){
      $http.post("../php/season.php",{'action':action,'id':id})
      .success(function(data){
        //console.log("id season:  "+id);
        $.toast({
          heading: 'Success',
          text: 'Delete Season.',
          showHideTransition: 'fade',
          icon: 'error'
      });
        getSeason();
          getYears();
      });
    });

  }

});
