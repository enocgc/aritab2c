<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;


require_once ("../models/product.php");
switch ($action) {
  case 1:
  $bd = new Products();
  echo $bd->getProduct();
  break;
  case 2:
  $bd = new Products();
  echo $bd->getLanguage();
  break;
  case 3:
  $bylocation = $data->bylocation;
  $byitinerary = $data->byitinerary;
  $bd = new Products();
  echo $bd->addService($bylocation,$byitinerary);
  break;
  case 4:
  $id= $data->id;
  $language_id = $data->language_id;
  $name= $data->name;
  //echo "idlangu: ".$language_id;
  $bd = new Products();
  echo $bd->addServiceDetails($id,$language_id,$name);
  break;
  case 5:
  $id = $data->id;
  $idlan = $data->idlan;
  $short = $data->short;
  $bd = new Products();
  echo $bd->getServicetoModal($id,$idlan,$short);
  break;
  case 6:
  $id = $data->id;
  $language_id = $data->language_id;
  $name= $data->name;
//  echo "id ".$id." lang ".$language_id." name ".$name;
  $bd = new Products();
  $bd->editService($id,$language_id,$name);
  break;
  case 8:
  $id = $data->id;
  $bd = new Products();
  //echo "id entra al php".$id;
  echo $bd->deleteProduct($id);
  break;
  case 9:
  $id = $data->id;
  $bd = new Products();
  echo $bd->getNameCountry($id);
  break;
  case 10:
  $id = $data->id;
  $bd = new Products();
  echo $bd->getNameLocation($id);
  break;
  case 11:
  $id = $data->id;
  $enabled = $data->enabled;
  $bd = new Products();
  //echo "estring";
  echo $bd->changeEnabled($id,$enabled);
  break;
  case 12:
  $bd = new Products();
  echo $bd->getService();
  break;
  case 13:
  $bd = new Products();
  echo $bd->getCountries();
  break;
  case 14:
  $bd = new Products();
  echo $bd->getLocation();
  break;
  default:
}

?>
