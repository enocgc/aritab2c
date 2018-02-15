<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;


require_once ("../models/tags.php");
switch ($action) {
  case 1:
  $bd = new Tags();
  echo $bd->getTags();
  break;
  case 2:
  $bd = new Tags();
  echo $bd->getLanguage();
  break;
  case 3:
  $enabled=1;
  $bd = new Tags();
  echo $bd->addTag($enabled);
  break;
  case 4:
  $id= $data->id;
  $language_id = $data->language_id;
  $name= $data->name;
  $description= $data->description;
  //echo "idlangu: ".$language_id;
  $bd = new Tags();
  echo  $bd->addTagDetails($id,$language_id,$name,$description);
  break;
  case 5:
  $id = $data->id;
  $idlan = $data->idlan;
  $short = $data->short;
  $bd = new Tags();
  echo $bd->getTagtoModal($id,$idlan,$short);
  break;
  case 6:
  $id = $data->id;
  $language_id = $data->language_id;
  $name= $data->name;
  $description= $data->description;
  //echo $id." ".$language_id." ".$name." ".$description;
  $bd = new Tags();
    $bd->editTags($id,$language_id,$name,$description);
  break;
  case 7:
  $id = $data->id;
  $enabled = $data->enabled;
  //echo "id ".$id." estado ".$enabled;
  $bd = new Tags();
  echo $bd->changeEnabled($id,$enabled);
  break;
  case 8:
  $id = $data->id;
  $bd = new Tags();
  $bd->deleteTag($id);
  break;
  case 9:
  $bd = new Tags();
  echo $bd->getTagsEnabled();
  break;
  default:
}

?>
