<?php
$data =json_decode(file_get_contents("php://input"));
$iduser = $data->iduserF;
$enabled = $data->enabledF;

require_once("../../includes/constantes.php");
$conn=new mysqli(__HOST__,__USER__,__PASSWD__,__DB_NAME__);
$sql="UPDATE user SET enabled='$enabled' WHERE iduser='$iduser'";
$result = $conn->query($sql);
$array=array();

?>
