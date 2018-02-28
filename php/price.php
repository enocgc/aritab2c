<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;


require_once ("../models/price.php");
switch ($action) {
  case 1:
  $bd = new Prices();
  echo $bd->getConvinations();
  break;
  default:
}

?>
