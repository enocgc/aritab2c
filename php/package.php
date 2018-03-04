<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;


require_once ("../models/package.php");
switch ($action) {
  case 1:
  $bd = new Package();
  echo $bd->addPackage();
  break;
  case 2:
  $package_id= $data->package_id;
  $language_id = $data->language_id;
  $name= $data->name;
  $description= $data->description;
  $bd = new Package();
  echo $bd->addPackageDetails($package_id,$language_id,$name,$description);
  break;
  case 3:
  $package_id= $data->package_id;
  $transporttype_id = $data->transporttype_id;
  $bd = new Package();
  echo $bd->addPackageTransport($package_id,$transporttype_id);
  break;
  case 4:
  $package_id= $data->package_id;
  $tag_id = $data->tag_id;
  $bd = new Package();
  echo $bd->addPackageTag($package_id,$tag_id);
  break;
  case 5:
  $package_id= $data->package_id;
  $location_id= $data->location_id;
  $position= $data->position;
  $minnights = $data->minnights;
  $acomodationid = $data->acomodationid;
  //echo "id ".$package_id." ".$location_id." ".$position." ".$minnights;
  $bd = new Package();
  echo $bd->addPackageroute($package_id,$location_id,$position,$minnights,$acomodationid);
  break;
  case 6:
  $packageroute_id= $data->packageroute_id;
  $quantityAcomodation= $data->quantityAcomodation;
  $quantity= $data->quantity;
  //echo "id ".$packageroute_id." ".$quantityAcomodation." ".$quantity;
  $bd = new Package();
  echo $bd->addpackageroute_services($packageroute_id,2,$quantityAcomodation);
  echo $bd->addpackageroute_services($packageroute_id,3,$quantity);
  break;
  case 7:
  $idProduct= $data->idProduct;
  $day= $data->day;
  $packageroutes= $data->packageroutes;
  $idacomodation= $data->idacomodation;
  echo "idProduct ".$idProduct." day ". $day."packageroutes ".$packageroutes." idacomodation ".$idacomodation;
  $bd = new Package();
  echo $bd->addpackageroute_products($packageroutes,2,$idacomodation,$day);
  echo $bd->addpackageroute_products($packageroutes,3,$idProduct,$day);
  break;
  default:
}

?>
