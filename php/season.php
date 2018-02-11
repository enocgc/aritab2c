<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;


require_once ("../models/season.php");
switch ($action) {
  case 1:
  # code
  $name = $data->name;
  $bd = new Seasons();
  $enabled=1;
  $bd->addSeason($name);
  break;
  case 2:
  $id = $data->id;
  $bd = new Seasons();
  $bd->deleteSeason($id);
  break;
  case 3:
  $bd = new Seasons();
  echo $bd->getSeason();
  break;
  case 4:
  $id = $data->idE;
  $stardate = $data->startdateE;
  $enddate = $data->enddateE;
  $bd = new Seasons();
  $bd->editSeason($id,$stardate,$enddate);
  break;
  case 5:
  $id= $data->idF;
  $enabled = $data->enabledF;
  $bd = new Seasons();
  echo $bd->changeEnabled($id,$enabled);
  break;
  case 6:
  $id = $data->id;
  $id2 = $data->id2;
  $bd = new Seasons();
  echo $bd->getSeasontoModal($id,$id2);
  break;
  case 7:
  $bd = new Seasons();
  echo $bd->getYears();
  break;
  case 8:
  $id = $data->id;
  $startdate = $data->startdate;
  $enddate = $data->enddate;
  $bd = new Seasons();
  $bd->addSeasonPeriods($id,$startdate,$enddate);
  break;
  default:
}




?>
