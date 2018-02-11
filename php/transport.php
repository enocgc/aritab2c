<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;


require_once ("../models/transport.php");
switch ($action) {
  case 1:
  $bd = new Transports();
  echo $bd->getTransport();
  break;
  case 2:
  $bd = new Transports();
  echo $bd->getLanguage();
  break;
  case 3:
  $bd = new Transports();
  echo $bd->addTransport();
  break;
  case 4:
  $id= $data->id;
  $language_id = $data->language_id;
  $name= $data->name;
  //echo "idlangu: ".$language_id;
  $bd = new Transports();
  echo $bd->addTransportDetails($id,$language_id,$name);
  break;
  case 5:
  $id = $data->id;
  $idlan = $data->idlan;
  $short = $data->short;
  $bd = new Transports();
  echo $bd->getTransporttoModal($id,$idlan,$short);
  break;
  case 6:
  $id = $data->id;
  $language_id = $data->language_id;
  $name= $data->name;
  // echo "id ".$id." lang ".$language_id." name ".$name;
  $bd = new Transports();
  $bd->editTransport($id,$language_id,$name);
  break;
  case 7:
  $id = $data->id;
  $bd = new Transports();
  //echo "id".$id;
  echo $bd->deleteTransport($id);
  break;
  case 8:
  $id = $data->id;
  $enabled = $data->enabled;
  //echo "id ".$id." estado ".$enabled;
  $bd = new Transports();
  echo $bd->changeEnabled($id,$enabled);
  break;
  default:
}

?>
