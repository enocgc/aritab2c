var loginApp = angular.module("loginApp", []);
loginApp.controller("loginController", function($scope, $http) {
    $scope.login = function() {
console.log("entro login");
        $http.post('php/login.php', {'usuario': $scope.usuario,'password': $scope.contrasena})
        .success(function(response) {
            console.log(response);
            if(response==1){
                window.location.replace("views/desktop.html");
            }else{
                alert("Usuario o contrasena incorrecto");

            }
        }, function errorCallback(response) {
            alert('error');
        });
    }
});