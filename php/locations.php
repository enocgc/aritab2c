<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;

// falta editar
require_once ("../models/locations.php");
switch ($action) {
  case 1:
  $bd = new Locations();
  echo $bd->getLocations();
  break;
  case 2:
  $enabled = $data->enabled;
  $id = $data->id;
  $bd = new Locations();
  echo $bd->changeEnabled($id,$enabled);
  break;
  // case 3:
  // $language_id = $data->language_id;
  // $bd = new Locations();
  // echo $bd->deleteCountryDetails($language_id);
  // break;
  // case 4:
  // break;


}

?>
