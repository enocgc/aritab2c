<?php
require_once ("../includes/conexion.php");
require_once ("../includes/constantes.php");
 class Countries extends Conexion
 {

  public function __construct(){
     parent::__construct(__HOST__, __USER__, __PASSWD__, __DB_NAME__);
  }//fin del constructor

  function getCountries(){
    $sql="SELECT a.name,a.language_id,b.gpslat,b.gpslong,a.enabled,b.id  FROM countrydetails AS a,countries AS b WHERE a.language_id=1 AND a.country_id=b.id AND b.enabled=1";
    $result = $this->cone->query($sql);
    $array=array();
    while($row = $result->fetch_assoc()){
      $array[]=array(
        'language_id'=>$row['language_id'],
        'name'=>$row['name'],
        'gpslat'=>$row['gpslat'],
        'gpslong'=> $row['gpslong'],
        'enabled'=> $row['enabled'],
        'id'=> $row['id']
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

  function changeEnabled($language_id,$enabled){
    $stmt=$this->cone->prepare("UPDATE countrydetails SET enabled=? WHERE language_id=?");
    if($stmt === FALSE){
      die("prepare() fail modificar: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('ss',$enabled,$language_id);
    $stmt->execute();
    $stmt->close();
    return true;
  }# fin del metodo modificar.

  function deleteCountryDetails($language_id){
    $stmt=$this->cone->prepare("DELETE FROM countrydetails WHERE language_id=?");
    if($stmt === FALSE){
      die("prepare() fail eliminar: ". $this->cone->error);
      return 0;
    }
    $stmt->bind_param('s',$language_id);
    $stmt->execute();
    $stmt->close();
    return 1;
  }// end to delete

  function addCountry($gpslat,$gpslong,$gpszoom,$enabled){
    $stmt= $this->cone->prepare("INSERT INTO countries(gpslat,gpslong,gpszoom,enabled) VALUES(?,?,?,?)");
    if($stmt === FALSE){
      die("prepare() fail: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('iiii',$gpslat,$gpslong,$gpszoom,$enabled);
    $stmt->execute();
    $stmt->close();
    //return true;
    $sql="SELECT (MAX(id)) AS id ,enabled As enabled FROM countries";
    $result = $this->cone->query($sql);
    $array=array();
    while($row = $result->fetch_assoc()){
      $array[]=array(
        'id'=>$row['id'],
        'enabled'=>$row['enabled']
      );
    }//fin del while
     if($result->num_rows > 0){
    return json_encode($array);
     }
    $this->close();
    return false;
  }// end to addCountry

}// fin de la clase
 ?>
