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
  $id = $data->id;
  $enabled = $data->enabled;
  $bd = new Countries();
  //echo "id".$id."estado".$enabled;
  echo $bd->changeEnabled($id,$enabled);
  break;
  case 3:
  $id = $data->id;
  $bd = new Countries();
  echo $bd->deleteCountry($id);
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
  case 7:
  //get a specific country
  $id= $data->id;
  $bd = new Countries();
  echo $bd->getCountry($id);
  break;
  case 8:
  //getlanguage
  $id= $data->id;
  $bd = new Countries();
  echo $bd->getLaguage($id);
  break;
  case 9:
  // getdatamedia
  $id= $data->id;
  $bd = new Countries();
  echo $bd->getMedia($id);
  break;
  case 10:
  // updatecountry
  $id= $data->id;
  $gpslat= $data->gpslat;
  $gpslong= $data->gpslong;
  $gpszoom= $data->gpszoom;
  $media_id= $data->media_id;
  $template_id= $data->template_id;
  $position= $data->position;
  $bd = new Countries();
  echo $bd->updateCountry($id,$gpslat,$gpslong,$gpszoom,$media_id,$template_id,$position);
  break;
  case 11:
  // update countrydetails
  $country_id= $data->country_id;
  $language_id= $data->language_id;
  $name= $data->name;
  $description= $data->description;
  $bd = new Countries();
  echo $bd->updateCountryDetails($country_id,$language_id,$name,$description);
  break;

}

?>
