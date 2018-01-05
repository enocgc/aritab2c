function load_userslist() {
 document.getElementById("contenedor-1").innerHTML='<object type="text/html" style="width: 100%; height: calc(100vh - 86px);" data="listusers.html" ></object>';
}

function load_listseason() {
 document.getElementById("contenedor-1").innerHTML='<object type="text/html" style="width: 100%; height: calc(100vh - 86px);" data="listseason.html" ></object>';
}
function load_adduser() {
 document.getElementById("contenedor-1").innerHTML='<object type="text/html" style="width: 100%; height: calc(100vh - 86px);" data="adduser.html" ></object>';
}
function cancel() {
  window.history.back();
}

function load_listlanguage() {
 document.getElementById("contenedor-1").innerHTML='<object type="text/html" style="width: 100%; height: calc(100vh - 86px);" data="listlanguages.html" ></object>';
}
function load_listproduct() {
 document.getElementById("contenedor-1").innerHTML='<object type="text/html" style="width: 100%; height: calc(100vh - 86px);" data="listproduct.html" ></object>';
}
function load_addproduct() {
 document.getElementById("contenedor-1").innerHTML='<object type="text/html" style="width: 100%; height: calc(100vh - 86px);" data="addproduct.html" ></object>';
}
$(document).ready(function() {
  $("#listausuario").click(function() {
    $("#contenedor-1").load("listusers.html");
  });
  $("#calcelar").click(function() {
    $("#contenedor-1").load("listusers.html");
  });
  $("#addusuario").click(function() {
    $("#contenedor-1").load("adduser.html");
  });
});
