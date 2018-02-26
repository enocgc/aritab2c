var loginApp = angular.module("loginApp", []);
loginApp.controller("loginController", function($scope, $http) {
//funcion para realizar el login
    $scope.login = function() {
     console.log("entro login del scope");
        $http.post('php/login.php', {'usuario': $scope.usuario,'password': $scope.contrasena})
        .success(function(response) {
            //console.log(response);
            if(response==1){
                window.location.replace("views/desktop.html");
            }else{
              $scope.menssage=0;

            }
        }, function errorCallback(response) {
            console.log('error');
        });
    }

    $scope.checkIfEnterKeyWasPressed = function($event){
        var keyCode = $event.which || $event.keyCode;
        if (keyCode === 13) {
            $scope.login();
        //  console.log("login");
        }

      }
});
