<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;


require_once ("../models/service.php");
switch ($action) {
  case 1:
  $bd = new Services();
  echo $bd->getService();
  break;
  case 2:
  $bd = new Services();
  echo $bd->getLanguage();
  break;
  case 3:
  $bylocation = $data->bylocation;
  $byitinerary = $data->byitinerary;
  $bd = new Services();
  echo $bd->addService($bylocation,$byitinerary);
  break;
  case 4:
  $id= $data->id;
  $language_id = $data->language_id;
  $name= $data->name;
  //echo "idlangu: ".$language_id;
  $bd = new Services();
  echo $bd->addServiceDetails($id,$language_id,$name);
  break;
  case 5:
  $id = $data->id;
  $idlan = $data->idlan;
  $short = $data->short;
  $bd = new Services();
  echo $bd->getServicetoModal($id,$idlan,$short);
  break;
  case 6:
  $id = $data->id;
  $language_id = $data->language_id;
  $name= $data->name;
//  echo "id ".$id." lang ".$language_id." name ".$name;
  $bd = new Services();
  $bd->editService($id,$language_id,$name);
  break;
  case 8:
  $id = $data->id;
  $bd = new Services();
//  echo "id".$id;
  echo $bd->deleteService($id);
  break;
}

?>
