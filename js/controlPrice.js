appRouter.controller('controlPrice',function($scope,$http,$timeout,$routeParams){


$scope.idPackage=$routeParams.id;
//console.log( $routeParams.id);
getConvinations();
getPaxOcupation();
getSeason();
getService();
 getPackageTransport();
function getConvinations(){
var action=1;
//necesita parametro para el get
 $http.post('../php/price.php', {'action':action,'id':$scope.idPackage})
 .success(function(data){
  $scope.convinations = data;
 //console.log(data);
 }).error(function(response){

 });
}

function getService() {
  var action = 12;
  //  console.log(action);
  $http.post('../php/product.php', {
      'action': action
    })
    .success(function(data) {
      //console.log(data);
      $scope.services = data;
    }).error(function(response) {});
}

function getPaxOcupation(){
  var action=1;
  //  console.log(action);
  $http.post('../php/paxocupation.php', {'action':action})
  .success(function(data){
    $scope.paxs = data;
    //console.log(data);
  }).error(function(response){
      console.log("No se get  pax");
  });
}

function getSeason(){
  var action=3;
  //  console.log(action);
  $http.post('../php/price.php', {'action':action})
  .success(function(data){
    $scope.seasons = data;
  //  console.log(data);
  }).error(function(response){
      console.log("No se get  season");
  });
}

function getPackageTransport(){
  var action=2;
  //  console.log(action);$scope.idTansport//parametro para obtener los transport
  $http.post('../php/price.php', {'action':action,'id':$scope.idPackage})
  .success(function(data){
    //  console.log(data);
    $scope.transportPs = data;
  }).error(function(response){
      console.log("No se get  transportpackage");
  });
}


$scope.addPrice=function(service_id,pax_id,transport_id,season_id,price){
var service=service_id;
var pax=pax_id;
var transport=transport_id;
var season=season_id;
var price=price;
  var action=4;
if (service != null && pax !=null && transport != null && season !=null && price !=null) {
 $http.post('../php/price.php', {'action':action,'service_id':service_id,'pax_id':pax_id,'transportpackage_id':transport_id,'seasonperiod_id':season_id,'price':price})
 .success(function(data){
    // console.log(data);
   $.toast({
   heading: 'Success',
   text: 'Add Price.',
   showHideTransition: 'slide',
   icon: 'success'
 });
   getPackageTransport();
   getConvinations($routeParams);
 }).error(function(response){
   $.toast({
     heading: 'Error',
     text: 'Not Add Price.',
     showHideTransition: 'fade',
     icon: 'error'
 });
 });
}else{
  $.extend({ alert: function (message, title) {
    $("<div></div>").dialog( {
      buttons: { "Ok": function () { $(this).dialog("close"); } },
      close: function (event, ui) { $(this).remove(); },
      resizable: false,
      title: title,
      modal: true
    }).text(message);
  }
  });
  $.toast({
    heading: 'Error',
    text: 'Complete information for create new price',
    icon: 'error',
     stack: false
});

}
  // console.log("sevice id "+service_id+" paxid "+pax_id+" transportid "+transport_id+" seasonid "+season_id+" priceid"+price);
}

$scope.deletePrice = function(service_id,pax_id,transport_id,season_id){
  // console.log("sevice id "+service_id+" paxid "+pax_id+" transportid "+transport_id+" seasonid "+season_id);
  var action=6;
  $("#confirmdelete").click(function(){
    var service=service_id;
    var pax=pax_id;
    var transport=transport_id;
    var season=season_id;
       console.log("correcto");
       $http.post('../php/price.php', {'action':action,'service_id':service_id,'pax_id':pax_id,'transportpackage_id':transport_id,'seasonperiod_id':season_id})
       .success(function(data){
           console.log(data);
           $.toast({
             heading: 'Success',
             text: 'Delete Price.',
             showHideTransition: 'fade',
             icon: 'error'
         });
         getPackageTransport();
         getConvinations($routeParams);
       }).error(function(response){
         $.toast({
           heading: 'Error',
           text: 'Not Update Price.',
           showHideTransition: 'fade',
           icon: 'error'
       });
       });

  });
}

$scope.savePrice = function(service_id,pax_id,transport_id,season_id,price){
  var action=5;
  var service=service_id;
  var pax=pax_id;
  var transport=transport_id;
  var season=season_id;
  var price=price;
  if (price!="") {
     console.log("correcto");
     $http.post('../php/price.php', {'action':action,'service_id':service_id,'pax_id':pax_id,'transportpackage_id':transport_id,'seasonperiod_id':season_id,'price':price})
     .success(function(data){
         // console.log(data);
       $.toast({
       heading: 'Success',
       text: 'Update Price.',
       showHideTransition: 'slide',
       icon: 'success'
     });
       getPackageTransport();
       getConvinations($routeParams);
     }).error(function(response){
       $.toast({
         heading: 'Error',
         text: 'Not Update Price.',
         showHideTransition: 'fade',
         icon: 'error'
     });
     });
  }else{
    $.toast({
      heading: 'Error',
      text: 'The price is empty',
      icon: 'error',
     stack: false
  });
  }
  //console.log("sevice id "+service_id+" paxid "+pax_id+" transportid "+transport_id+" seasonid "+season_id+" priceid"+price);
}



});
