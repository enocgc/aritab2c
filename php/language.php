<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;


require_once ("../models/language.php");
switch ($action) {
  case 1:
    # code
    $name = $data->name;
    $short = $data->short;
    $icon = $data->icon;
    $bd = new Languages();
    $enabled=1;
    $bd->addLanguage($name,$short,$icon,$enabled);
    break;
  case 2:
      $id = $data->id;
      $bd = new Languages();
      $bd->deleteLanguage($id);
    break;

  case 3:
    $bd = new Languages();
    echo $bd->getLanguage();
  break;
  case 4:
  $id = $data->idE;
  $name = $data->nameE;
  $short = $data->shortE;
  $icon = $data->iconE;
  $bd = new Languages();
   $bd->editLanguage($id,$name,$short,$icon);
  break;
  case 5:
  $id= $data->idF;
  $enabled = $data->enabledF;
  $bd = new Languages();
    echo $bd->changeEnabled($id,$enabled);
  break;
  case 6:
  $id = $data->id;
    $bd = new Languages();
    echo $bd->getLanguagetoModal($id);
  break;
  default:
}




 ?>
