<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;
$iduser = $data->iduser;

require_once ("../models/user.php");

$bd = new Users();
 if($action="deleteUser"){
  $bd->deleteUser($iduser);
}

 ?>
