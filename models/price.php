<?php
require_once ("../includes/conexion.php");
require_once ("../includes/constantes.php");
 class Prices extends Conexion
 {
	public function __construct(){
     parent::__construct(__HOST__, __USER__, __PASSWD__, __DB_NAME__);
	}//fin del constructor
  function deletePaxOcupation($id){
      $stmt=$this->cone->prepare("DELETE FROM paxoccupations WHERE id=?");
      if($stmt === FALSE){
        die("prepare() fail eliminar: ". $this->cone->error);
        return 0;
      }
      $stmt->bind_param('s',$id);
      $stmt->execute();
      $stmt->close();
      return 1;
    }# fin del metodo eliminar.

    function editPax($id,$pax,$occupation_id){
      $stmt=$this->cone->prepare("UPDATE paxoccupations SET pax=?,occupation_id=? WHERE id=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        echo 0;
      }
      $stmt->bind_param('sss',$pax,$occupation_id,$id);
      //echo "id ".$id."idl ".$language_id."$name ".$name."$description ".$description;
      $stmt->execute();
      $stmt->close();
      echo 1;
    }# fin del metodo modificar.


    function changeEnabled($id,$enabled){
      $stmt=$this->cone->prepare("UPDATE paxoccupations SET enabled=? WHERE id=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        return false;
      }
      $stmt->bind_param('ss',$enabled,$id);
      $stmt->execute();
      $stmt->close();
      return true;
    }# fin del metodo modificar.



function addPaxOcupation($pax,$occupation_id,$enabled){
  $stmt= $this->cone->prepare("INSERT INTO paxoccupations(pax,occupation_id,enabled) VALUES(?,?,?)");
  if($stmt === FALSE){
    die("prepare() fail: ". $this->cone->error);
    return false;
  }
  $stmt->bind_param('sss',$pax,$occupation_id,$enabled);
  $stmt->execute();
  $stmt->close();
}


    function getConvinations(){
      //SELECT a.name,a.id, b.startdate,b.enddate FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id
  $sql="SELECT DISTINCT
  servicedetails.name,
  occupations.id AS occupation,
  occupations.persons AS pax,
  transporttypedetail.name AS name1,
  seasons.name AS name2,
  seasonperiods.startdate,
  seasonperiods.enddate,
  prices.price
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
  packages.id = 1";
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



}
?>
