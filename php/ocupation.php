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
  $id = $data->idE;
  $persons=$data->persons;

  //echo "id ".$id." persons ".$persons;
  $bd = new Ocupations();
   $bd->editOcupation($id,$persons);
  break;
  case 7:
  $id= $data->idE;
  $language_id = $data->language_id;
  $description= $data->description;
  //echo "id ".$id." language_id ".$language_id." description".$description;
  $bd = new Ocupations();
  $bd->editOcupationDetails($id,$language_id,$description);

  break;
  case 8:
  $id = $data->id;
  $bd = new Ocupations();
  //echo "id".$id;
  echo $bd->deleteOcupation($id);
  break;
  default:
}

?>
