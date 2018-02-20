<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;


require_once ("../models/paxocupation.php");
switch ($action) {
  case 1:
  $bd = new Paxs();
  echo $bd->getPaxOcupation();
  break;
  case 3:
  $pax = $data->pax;
  $occupation_id = $data->occupation_id;
  $enabled=1;
  $bd = new Paxs();
  echo $bd->addPaxOcupation($pax,$occupation_id,$enabled);
  break;
  case 5:
  $id = $data->id;
  $idlan = $data->idlan;
  $short = $data->short;
  $bd = new Paxs();
  echo $bd->getTagtoModal($id,$idlan,$short);
  break;
  case 6:
  $id = $data->id;
  $language_id = $data->language_id;
  $name= $data->name;
  $description= $data->description;
  //echo $id." ".$language_id." ".$name." ".$description;
  $bd = new Paxs();
    $bd->editTags($id,$language_id,$name,$description);
  break;
  case 7:
  $id = $data->id;
  $enabled = $data->enabled;
  //echo "id ".$id." estado ".$enabled;
  $bd = new Paxs();
  echo $bd->changeEnabled($id,$enabled);
  break;
  case 8:
  $id = $data->id;
  $bd = new Paxs();
  $bd->deletePaxOcupation($id);
  break;
  case 9:
  $bd = new Paxs();
  echo $bd->getTagsEnabled();
  break;
  default:
}

?>
