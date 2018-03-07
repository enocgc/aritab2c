<?php
require_once ("../includes/conexion.php");
require_once ("../includes/constantes.php");
 class Prices extends Conexion
 {
	public function __construct(){
     parent::__construct(__HOST__, __USER__, __PASSWD__, __DB_NAME__);
	}//fin del constructor


    function getConvinations($id){
      //SELECT a.name,a.id, b.startdate,b.enddate FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id
  $sql="SELECT DISTINCT
  servicedetails.name,
  occupations.id AS occupation,
  occupations.persons AS pax,
  paxoccupations.id AS paxocupationid,
  transporttypedetail.name AS name1,
  package_transportoptions.id AS packagetransportid,
  seasons.name AS name2,
  seasonperiods.startdate,
  seasonperiods.enddate,
  seasonperiods.id AS seasonperiodid,
  prices.price,
  prices.service_id AS serviceid
FROM
  prices
  INNER JOIN servicedetails ON servicedetails.service_id = prices.service_id
  INNER JOIN paxoccupations ON prices.paxoccupation_id = paxoccupations.id
  INNER JOIN occupations ON paxoccupations.occupation_id = occupations.id
  INNER JOIN package_transportoptions ON prices.packagetransportoption_id = package_transportoptions.id
  INNER JOIN transporttypedetail ON package_transportoptions.transporttype_id = transporttypedetail.transporttype_id
  INNER JOIN seasonperiods ON prices.seasonperiod_id = seasonperiods.id
  INNER JOIN seasons ON seasonperiods.season_id = seasons.id
  INNER JOIN packages ON package_transportoptions.package_id = packages.id
WHERE
  servicedetails.language_id = 1 AND
  transporttypedetail.language_id = 1 AND
  packages.id =$id";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'name'=>$row['name'],
          'occupation'=>$row['occupation'],
          'pax'=>$row['pax'],
          'name1'=>$row['name1'],
          'name2'=>$row['name2'],
          'startdate'=>$row['startdate'],
          'enddate'=>$row['enddate'],
          'price'=>$row['price'],
          'seasonperiodid'=>$row['seasonperiodid'],
          'serviceid'=>$row['serviceid'],
          'packagetransportid'=>$row['packagetransportid'],
          'paxocupationid'=>$row['paxocupationid']
        );
      }//fin del while
      //return "texto";
       if($result->num_rows > 0){
      return json_encode($array);
       }
      $this->close();
      //return $variable;
     return false;
    }# fin del metodo consulta


function getPackageTransport($id){
  $sql="SELECT
  transporttypedetail.name,
  transporttypedetail.language_id,
  package_transportoptions.package_id AS packageid,
  package_transportoptions.id AS packtransid
FROM
  package_transportoptions
  INNER JOIN transporttypedetail ON package_transportoptions.transporttype_id = transporttypedetail.transporttype_id
WHERE
  transporttypedetail.language_id = 1 AND
  package_transportoptions.package_id =  $id";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'name'=>$row['name'],
          'packageid'=>$row['packageid'],
          'packtransid'=>$row['packtransid']
        );
      }//fin del while
      //return "texto";
       if($result->num_rows > 0){
      return json_encode($array);
       }
      $this->close();
      //return $variable;
     return false;
}

function getSeason(){
  $sql="SELECT
  seasons.name,
  seasonperiods.startdate,
  seasonperiods.enddate,
  seasonperiods.id AS id1
FROM
  seasons
  INNER JOIN seasonperiods ON seasonperiods.season_id = seasons.id";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'id'=>$row['id1'],
          'name'=>$row['name'],
          'startdate'=>$row['startdate'],
          'enddate'=>$row['enddate']
        );
      }//fin del while
      //return "texto";
       if($result->num_rows > 0){
      return json_encode($array);
       }
      $this->close();
      //return $variable;
     return false;
}
//funcion para agregar precios
function addPrice($service_id,$pax_id,$transportpackage_id,$seasonperiod_id,$price){
//echo "datos : service ".$service_id." pax ".$pax_id." transport ".$transportpackage_id." season ".$seasonperiod_id." price ".$price;
$stmt= $this->cone->prepare("INSERT IGNORE INTO prices(service_id,paxoccupation_id,packagetransportoption_id,seasonperiod_id,price) VALUES(?,?,?,?,?)");
if($stmt === FALSE){
  die("prepare() fail: ". $this->cone->error);
  return false;
}
$stmt->bind_param('iiiii',$service_id,$pax_id,$transportpackage_id,$seasonperiod_id,$price);
$stmt->execute();
$stmt->close();
return 1;
}
//funcion para actualiza precios
function updatePrice($service_id,$pax_id,$transportpackage_id,$seasonperiod_id,$price){
//echo "datos : service ".$service_id." pax ".$pax_id." transport ".$transportpackage_id." season ".$seasonperiod_id." price ".$price;
$stmt=$this->cone->prepare("UPDATE prices SET price=? WHERE service_id=? AND paxoccupation_id=? AND packagetransportoption_id=? AND seasonperiod_id=?");
 if($stmt === FALSE){
   die("prepare() fail modificar: ". $this->cone->error);
   echo 0;
 }
 $stmt->bind_param('iiiii',$price,$service_id,$pax_id,$transportpackage_id,$seasonperiod_id);
 $stmt->execute();
 $stmt->close();
 return true;
}
//funcion para eliminar precios
function deletePrice($service_id,$pax_id,$transportpackage_id,$seasonperiod_id){
//echo "datos : service ".$service_id." pax ".$pax_id." transport ".$transportpackage_id." season ".$seasonperiod_id." price ".$price;
$stmt=$this->cone->prepare("DELETE FROM prices WHERE service_id=? AND paxoccupation_id=? AND packagetransportoption_id=? AND seasonperiod_id=?");
 if($stmt === FALSE){
   die("prepare() fail modificar: ". $this->cone->error);
   echo 0;
 }
 $stmt->bind_param('iiii',$service_id,$pax_id,$transportpackage_id,$seasonperiod_id);
 $stmt->execute();
 $stmt->close();
 return true;
}

}
?>
