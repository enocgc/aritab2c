<?php
$data =json_decode(file_get_contents("php://input"));
$iduser = $data->iduserE;
$name = $data->nameE;
$user = $data->userE;
$password = $data->passwordE;
$email = $data->emailE;
$phone = $data->phoneE;
$country = $data->countryE;
$company = $data->companyE;
$passwordEncript=md5($password);

require_once("../../includes/constantes.php");
$conn=new mysqli(__HOST__,__USER__,__PASSWD__,__DB_NAME__);
$sql="UPDATE user SET name='$name',user='$user',password='$passwordEncript',email='$email',phone='$phone',country='$country',company='$company' where iduser='$iduser'";
$result = $conn->query($sql);
$array=array();


?>
