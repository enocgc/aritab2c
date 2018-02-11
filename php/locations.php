<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;

// falta editar
require_once ("../models/countries.php");
switch ($action) {
  case 1:
  $bd = new Locations();
  echo $bd->getCountries();
  break;
  // case 2:
  // $language_id = $data->language_id;
  // $enabled = $data->enabled;
  // $bd = new Locations();
  // echo $bd->changeEnabled($language_id,$enabled);
  // break;
  // case 3:
  // $language_id = $data->language_id;
  // $bd = new Locations();
  // echo $bd->deleteCountryDetails($language_id);
  // break;
  // case 4:
  // break;


}

?>
