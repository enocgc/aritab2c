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
  case 3:
  $id= $data->id;
  $bd = new Locations();
  echo $bd->getLocation($id);
  break;
  case 4:
  $id= $data->id;
  $bd = new Locations();
  echo $bd->getLaguage($id);
  break;
  case 5:
  $id= $data->id;
  $bd = new Locations();
  echo $bd->getMedia($id);
  break;
   case 6:
  // updateLocation
  $id= $data->id;
  $gpslat= $data->gpslat;
  $gpslong= $data->gpslong;
  $gpszoom= $data->gpszoom;
  $media_id= $data->media_id;
  $template_id= $data->template_id;
  $position= $data->position;
  $country_id= $data->country_id;
  $bd = new Locations();
  echo $bd->updateLocation($id,$gpslat,$gpslong,$gpszoom,$media_id,$template_id,$position,$country_id);
  break;
   case 7:
  // update countrydetails
  $location_id= $data->location_id;
  $language_id= $data->language_id;
  $name= $data->name;
  $description= $data->description;
  $bd = new Locations();
  echo $bd->updateLocationDetails($location_id,$language_id,$name,$description);
  break;
  case 8:
  $id = $data->id;
  $bd = new Locations();
  echo $bd->deleteLocation($id);
  break;
  case 9:
  $bd = new Locations();
  echo $bd->getCountries();
  break;
  case 10:
  $country_id= $data->country_id;
  $gpslat= $data->gpslat;
  $gpslong= $data->gpslong;
  $gpszoom= $data->gpszoom;
  $enable=1;
  $template_id=$data->template_id;
  $media_id=$data->media_id;
  $position=$data->position;
  $bd= new Locations();
  echo $bd->addLocation($country_id,$gpslat,$gpslong,$gpszoom,$enable,$media_id,$template_id,$position);
  break;
  case 11:
  $location_id= $data->location_id;
  $language_id= $data->language_id;
  $name= $data->name;
  $description= $data->description;
  $enabled=1;
  $bd= new Locations();
  echo $bd->addLocationDetails($location_id,$language_id,$name,$description,$enabled); 
  break;


}

?>
