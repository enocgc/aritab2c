<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;


require_once ("../models/product.php");
switch ($action) {
  case 1:
  $bd = new Products();
  echo $bd->getProducts();
  break;
  case 2:
  //getlanguage
  $id= $data->id;
  $bd = new Products();
  echo $bd->getLaguage($id);
  break;
  case 3:
  $bylocation = $data->bylocation;
  $byitinerary = $data->byitinerary;
  $bd = new Products();
  echo $bd->addService($bylocation,$byitinerary);
  break;
  case 4:
  $service_id= $data->service_id;
  $country_id= $data->country_id;
  $location_id= $data->location_id;
  $gpslat= $data->gpslat;
  $gpslong = $data->gpslong;
  $gpszoom= $data->gpszoom;
  $enabled= 1;
  $bd = new Products();
  echo $bd->addProduct($service_id,$country_id,$location_id,$gpslat,$gpslong,$gpszoom,$enabled);
  break;
  case 5:
  $product_id= $data->product_id;
  $language_id = $data->language_id;
  $name= $data->name;
  $description= $data->description;
  $bd = new Products();
  echo $bd->addProductDetails($product_id,$language_id,$name,$description);
  break;
  case 6:
  $product_id= $data->product_id;
  $media_id = $data->media_id;
  $template_id= $data->template_id;
  $position= $data->position;
  $bd = new Products();
  echo $bd->addProductMedia($product_id,$media_id,$template_id,$position);
  break;
  case 7:
  $id= $data->id;
  $bd = new Products();
  echo $bd->getProduct($id);
  break;
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
  case 15:
  // getdatamedia
  $id= $data->id;
  $bd = new Products();
  echo $bd->getMedia($id);
  break;
  case 16:
  $id= $data->id;
  $service_id= $data->service_id;
  $country_id= $data->country_id;
  $location_id= $data->location_id;
  $gpslat= $data->gpslat;
  $gpslong= $data->gpslong;
  $gpszoom= $data->gpszoom;
  $media_id= $data->media_id;
  $template_id= $data->template_id;
  $position= $data->position;
  $bd = new Products();
  echo $bd->updateProduct($id,$service_id,$country_id,$location_id,$gpslat,$gpslong,$gpszoom,$media_id,$template_id,$position);
  break;
  case 17:
  // update productdetails
  $product_id= $data->product_id;
  $language_id= $data->language_id;
  $name= $data->name;
  $description= $data->description;
  $bd = new Products();
  echo $bd->updateProductDetails($product_id,$language_id,$name,$description);
  break;
  case 18:
  $bd = new Products();
  echo $bd->getProductsEnabled();
  break;
  case 19:
  $id= $data->id;
  $bd = new Products();
  echo $bd->getProductsEnabledid($id);
  break;
  default:
}

?>
