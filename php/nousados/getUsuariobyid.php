<?php
$data =json_decode(file_get_contents("php://input"));
$iduser = $_GET['iduser'];

require_once("../../includes/constantes.php");
$conn=new mysqli(__HOST__,__USER__,__PASSWD__,__DB_NAME__);

$sql="SELECT * FROM user where iduser='$iduser'";
$result = $conn->query($sql);
$array=array();
while($row = $result->fetch_assoc()){
  $array[]=array(
    'iduser'=>$row['iduser'],
    'name'=>$row['name'],
    'user'=>$row['user'],
    'password'=> $row['password'],
    'email'=> $row['email'],
    'phone'=> $row['phone'],
    'country'=> $row['country'],
    'company'=> $row['company'],
    'enabled'=> $row['enabled']
  );
}//fin del while

echo json_encode($array);
?>
