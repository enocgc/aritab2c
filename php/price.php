<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;

require_once ("../models/price.php");
switch ($action) {
  case 1:
  $id = $data->id;
  $bd = new Prices();
  echo $bd->getConvinations($id);
  break;
  case 2:
  $id = $data->id;
  $bd = new Prices();
  echo $bd->getPackageTransport($id);
  break;
  case 3:
  $bd = new Prices();
  echo $bd->getSeason();
  break;
  case 4:
  $service_id = $data->service_id;
  $pax_id = $data->pax_id;
  $transportpackage_id = $data->transportpackage_id;
  $seasonperiod_id = $data->seasonperiod_id;
  $price = $data->price;
  //echo "datos : ".$service_id." ".$pax_id." ".$transportpackage_id." ".$seasonperiod_id." ".$price;
  $bd = new Prices();
  echo $bd->addPrice($service_id,$pax_id,$transportpackage_id,$seasonperiod_id,$price);
  break;
  case 5:
  $service_id = $data->service_id;
  $pax_id = $data->pax_id;
  $transportpackage_id = $data->transportpackage_id;
  $seasonperiod_id = $data->seasonperiod_id;
  $price = $data->price;
   //echo "datos : ".$service_id." ".$pax_id." ".$transportpackage_id." ".$seasonperiod_id." ".$price;
  $bd = new Prices();
  echo $bd->updatePrice($service_id,$pax_id,$transportpackage_id,$seasonperiod_id,$price);
  break;
  case 6:
  $service_id = $data->service_id;
  $pax_id = $data->pax_id;
  $transportpackage_id = $data->transportpackage_id;
  $seasonperiod_id = $data->seasonperiod_id;
   echo "datos : ".$service_id." ".$pax_id." ".$transportpackage_id." ".$seasonperiod_id;
  $bd = new Prices();
  echo $bd->deletePrice($service_id,$pax_id,$transportpackage_id,$seasonperiod_id);
  break;
  default:
}

?>
