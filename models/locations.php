<?php
require_once ("../includes/conexion.php");
require_once ("../includes/constantes.php");
 class Locations extends Conexion
 {

	public function __construct(){
     parent::__construct(__HOST__, __USER__, __PASSWD__, __DB_NAME__);
	}//fin del constructor

  function getLocations(){
    $sql="SELECT a.name,a.description,b.id,b.country_id,a.location_id,a.language_id,b.enabled FROM locationdetails AS a,locations AS b WHERE b.id=a.location_id AND language_id=1 ORDER BY b.id";
    $result = $this->cone->query($sql);
    $array=array();
    $columnCountry="aa";
    while($row = $result->fetch_assoc()){
        $uno=$row['country_id'];
        $dos=$row['language_id'];
        $sql2="SELECT name FROM countrydetails WHERE country_id=$uno AND language_id=1 AND language_id=1";
        $result2 = $this->cone->query($sql2);
        while($row2 = $result2->fetch_assoc()){
            $columnCountry=$row2['name'];
        }
      $array[]=array(
        'id'=>$row['id'],
        'name'=>$row['name'],
        'description'=>$row['description'],
        'country'=>$columnCountry,
        'enabled'=>$row['enabled'],
        'language_id'=>$row['language_id']
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

  function changeEnabled($id,$enabled){
    $stmt=$this->cone->prepare("UPDATE locations SET enabled=? WHERE id=?");
    if($stmt === FALSE){
      die("prepare() fail modificar: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('si',$enabled,$id);
    $stmt->execute();
    $stmt->close();
    return true;
  }# fin del metodo modificar.

  function deleteLocationsDetails($language_id){
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


}// fin de la clase
 ?>
