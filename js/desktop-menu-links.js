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
