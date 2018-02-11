<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;


require_once ("../models/ocupation.php");
switch ($action) {
  case 1:
  $bd = new Ocupations();
  echo $bd->getOcupation();
  break;
  case 2:
  $bd = new Services();
  echo $bd->getLanguage();
  break;
  case 3:
  $id= $data->id;
  $persons = $data->persons;
  $bd = new Ocupations();
  echo $bd->addOcupation($id,$persons);
  break;
  case 4:
  $id= $data->id;
  $language_id = $data->language_id;
  $description= $data->description;
  //echo "id ".$id." lang ".$language_id." descr: ".$description;
  $bd = new Ocupations();
  echo $bd->addOcupationDetails($id,$language_id,$description);
  break;
  case 5:
  $id = $data->id;
  $idlan = $data->idlan;
  $short = $data->short;
  //echo "id ".$id." lang ".$idlan." $short: ".$short;
  $bd = new Ocupations();
  echo $bd->getOcupationtoModal($id,$idlan,$short);
  break;
  case 6:
  $id = $data->id;
  $language_id = $data->language_id;
  $name= $data->name;
//  echo "id ".$id." lang ".$language_id." name ".$name;
  $bd = new Ocupations();
  $bd->editService($id,$language_id,$name);
  break;
  case 8:
  $id = $data->id;
  $bd = new Ocupations();
  //echo "id".$id;
  echo $bd->deleteService($id);
  break;
  default:
}

?>
