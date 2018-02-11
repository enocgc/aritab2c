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
  case 5:
  $country_id= $data->country_id;
  $language_id = $data->language_id;
  $name= $data->name;
  $description= $data->description;
  $enabled= 1;
  $bd = new Countries();
  echo $bd->addCountryDetails($country_id,$language_id,$name,$description,$enabled);
  break;
  case 6:
  $country_id= $data->country_id;
  $media_id = $data->media_id;
  $template_id= $data->template_id;
  $position= $data->position;
  $bd = new Countries();
  echo $bd->addCountryMedia($country_id,$media_id,$template_id,$position);
  break;


}

?>
