//cree los controladores
appRouter.controller('controlTags',function($scope,$http,$timeout){
  console.log("tags run");
  getTags();
  getLanguage();
  $scope.tags;
  function getTags(){
    var action=1;
    //  console.log(action);
    $http.post('../php/tags.php', {'action':action})
    .success(function(data){
      $scope.tags = data;
      console.log(data);
      //  console.log($scope.seasons);
      // alert("get exitoso");
    }).error(function(response){
      alert("No se get  tags");
    });
  }
  $scope.languages;
  function getLanguage(){
    var action=2;
    //console.log(action);
    $http.post('../php/tags.php', {'action':action})
    .success(function(data){
      $scope.languages = data;
    //  console.log($scope.languages);
      // alert("get exitoso");
    }).error(function(response){
      alert("No se get el Language");
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
        console.log("entro "+i+$scope.languages[i].short);
        var name= document.getElementById('name-'+$scope.languages[i].short).value;
        var description= document.getElementById('description-'+$scope.languages[i].short).value;
        var langid = $scope.languages[i].id;
        console.log("langid1");
        console.log(langid);
        console.log("Vector vuelta "+i);
        console.log($scope.languages[i]);
        $http.post('../php/tags.php', {'action':4,'id': $scope.newTag[0].id,'language_id':langid,'name':name,'description':description})//creo el tag
        .success(function(data){
          console.log("se agrego el tag correctamente");
        }).error(function(response){
          alert("No nserto tag");
        });
      }//fin del for
      setTimeout(function () {//para que actualice los campos de forma eficiente
          $scope.$apply(function () {
            getTags();
            console.log("se agrego nuevo tag");
          });
      }, 100);

      // alert("get exitoso");
    }).error(function(response){
      alert("No iserto tag");
    });
}

//funcion para mostrar datos en getLanguagetoModal
$scope.getTagtoModal=function(lang,id){
  getLanguage();
  $scope.idTagE=id;
  var action=5;
  console.log(action);
$scope.contador=0;
$scope.vector=[];
getTags();
  for (var i = 0; i <  lang.length; i++) {
    var langid = $scope.languages[i].id;
    var short = $scope.languages[i].short;
    //console.log($scope.languages[i].short);
    $http.post('../php/tags.php', {'action':action,'id':id,'idlan':langid,'short':short})
    .success(function(data){
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
      console.log("vector"+$scope.contador+" lang "+lang.length);
      $scope.contador=$scope.contador+1;
    }).error(function(response){
      alert("No se get el tags");
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
}//fin funcon edit
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
  $http.post('../php/tags.php', {'action':action,'id':id,'enabled':estado})
  .success(function(data){
    console.log(data);
    getTags();
    console.log("actulizado exitosamente el estado");
  }).error(function(response){
    console.log("No se actualizo el el estado");
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
