<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;

// falta editar
require_once ("../models/countries.php");
switch ($action) {
  case 1:
  $bd = new Countries();
  echo $bd->getCountries();
  break;
  case 2:
  $language_id = $data->language_id;
  $enabled = $data->enabled;
  $bd = new Countries();
  echo $bd->changeEnabled($language_id,$enabled);
  break;
  case 3:
  $language_id = $data->language_id;
  $bd = new Countries();
  echo $bd->deleteCountryDetails($language_id);
  break;
  case 4:
  $gpslat= $data->gpslat;
  $gpslong = $data->gpslong;
  $gpszoom= $data->gpszoom;
  $enabled= 1;
  $bd = new Countries();
  echo $bd->addCountry($gpslat,$gpslong,$gpszoom,$enabled);
  break;


}

?>
