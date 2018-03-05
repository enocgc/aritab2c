<?php
require_once ("../includes/conexion.php");
require_once ("../includes/constantes.php");
 class Prices extends Conexion
 {
	public function __construct(){
     parent::__construct(__HOST__, __USER__, __PASSWD__, __DB_NAME__);
	}//fin del constructor

    function getConvinations(){
      //SELECT a.name,a.id, b.startdate,b.enddate FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id
  $sql="SELECT DISTINCT
  servicedetails.name,
  occupations.id AS occupation,
  occupations.persons AS pax,
  transporttypedetail.name AS name1,
  seasons.name AS name2,
  seasonperiods.startdate,
  seasonperiods.enddate
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
  transporttypedetail.language_id = 1";
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
