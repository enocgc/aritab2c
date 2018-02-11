<?php
// require("loginout.php");
require("session.php");

require_once("../includes/constantes.php");
 $conn=new mysqli(__HOST__,__USER__,__PASSWD__,__DB_NAME__);
$data =json_decode(file_get_contents("php://input"));
$usuario = $data->usuario;
$password = $data->password;
$encript=md5($password);
//encript=hash('sha256', (get_magic_quotes_gpc() ? stripslashes($password) : $password));
//echo("pass: ".$encript);
$sql="SELECT * FROM user where user='$usuario' and password='$encript' and enabled=1";
$result = $conn->query($sql);
$autenticado=0;

while($row = $result->fetch_assoc()){
$_SESSION['USER']=$row['user'];
$_SESSION['ID']=$row['iduser'];
$autenticado=1;
}



echo json_encode($autenticado);
?>
