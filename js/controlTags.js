//cree los controladores
appRouter.controller('controlTags',function($scope,$http,$timeout){
  getTags();
  getLanguage();
  $scope.tags;
  function getTags(){
    var action=1;
    //  console.log(action);
    $http.post('../php/tags.php', {'action':action})
    .success(function(data){
      $scope.tags = data;
    }).error(function(response){
      console.log("No se get  tags");
    });
  }
  $scope.languages;
  function getLanguage(){
    var action=2;
    //console.log(action);
    $http.post('../php/tags.php', {'action':action})
    .success(function(data){
      $scope.languages = data;
    }).error(function(response){
        console.log("No se get el Language");
    });
  }
//funcion para agregar detalles
  $scope.addTag = function($lang){
    var action=3;
    $http.post('../php/tags.php', {'action':action})//creo el tag
    .success(function(data){
      $scope.newTag = data;
      //crear funcion para anadir detalle por idioma el siclo me jala los datos y podemos mandar el id del idioma como parametro
      for (var i = 0; i <  $lang.length; i++) {
        var name= document.getElementById('name-'+$scope.languages[i].short).value;
        var description= document.getElementById('description-'+$scope.languages[i].short).value;
        var langid = $scope.languages[i].id;

        $http.post('../php/tags.php', {'action':4,'id': $scope.newTag[0].id,'language_id':langid,'name':name,'description':description})//creo el tag
        .success(function(data){
          //console.log("se agrego el tag correctamente");
        }).error(function(response){
          //  console.log("No inserto tag");
        });
      }//fin del for
      setTimeout(function () {//para que actualice los campos de forma eficiente
          $scope.$apply(function () {
            getTags();
            $.toast({
            heading: 'Success',
            text: 'Add Tag.',
            showHideTransition: 'slide',
            icon: 'success'
          });
          });
      }, 100);

      // alert("get exitoso");
    }).error(function(response){
      $.toast({
                  heading: 'Error',
                  text: 'Not Add Tag',
                  showHideTransition: 'fade',
                  icon: 'error'
              });
    });
}

//funcion para mostrar datos en getLanguagetoModal
$scope.getTagtoModal=function(lang,id){
  getLanguage();
  //console.log(id);
  $scope.idTagE=id;
  var action=5;
$scope.contador=0;
$scope.vector=[];
getTags();
  for (var i = 0; i <  lang.length; i++) {
    var langid = $scope.languages[i].id;
    var short = $scope.languages[i].short;
    //console.log($scope.languages[i].short);
    $http.post('../php/tags.php', {'action':action,'id':id,'idlan':langid,'short':short})
    .success(function(data){
      //console.log(data);
      $scope.TagsE = data;
      var cont=$scope.contador;
    //  console.log(data);

         setTimeout(function () {//para que actualice los campos de forma eficiente
             $scope.$apply(function () {
               $("#nameE-"+data[0].short).val(data[0].name);
                $("#descriptionE-"+data[0].short).val(data[0].description);
             });
         }, 300);

      //usamos el contador para saber si todas las peticiones se hiceron
      $scope.contador=$scope.contador+1;
    }).error(function(response){

    });

  }
}
$scope.editTag =function($lang){
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

    getTags();
    if ($lang.length==$scope.contador+1) {
      $.toast({
      heading: 'Success',
      text: 'Update Tag.',
      showHideTransition: 'slide',
      icon: 'success'
    });
    }

    if($lang.length==$scope.contador+1){
      getLanguage()
    }
    $scope.contador++;
  }).error(function(response){
      if ($lang.length==$scope.contador+1) {
    $.toast({
                heading: 'Error',
                text: 'Not Update Tag',
                showHideTransition: 'fade',
                icon: 'error'
            });
              }
  });
}
}//fin funcon edit
//funcion para cambiar el estado
$scope.changeenabled = function(id,enabled){
  var estado;
  if(enabled==0){
     estado=1;
  }else{
     estado=0;
  }
  var action=7;
  $http.post('../php/tags.php', {'action':action,'id':id,'enabled':estado})
  .success(function(data){
    getTags();
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
}//fin funcioncambiar estado

//funcion para eliminar por id
$scope.deleteTag = function(id){
    console.log("id season:  "+id);
  var action=8;
  console.log(action);
  $("#confirmdelete").click(function(){
    $http.post("../php/tags.php",{'action':action,'id':id})
    .success(function(data){
      setTimeout(function () {//para que actualice los campos de forma eficiente
          $scope.$apply(function () {
            if(data=1){
              getTags();
              $.toast({
                heading: 'Success',
                text: 'Delete Tag.',
                showHideTransition: 'fade',
                icon: 'error'
            });
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
