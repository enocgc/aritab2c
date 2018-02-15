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
        $sql2="SELECT name FROM countrydetails WHERE country_id=$uno AND language_id=1";
        $result2 = $this->cone->query($sql2);
        while($row2 = $result2->fetch_assoc()){
            $columnCountry=$row2['name'];
        }
        $result2->close();
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
      $result->close();
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
    $stmt=$this->cone->prepare("DELETE FROM countrydetailss WHERE language_id=?");
    if($stmt === FALSE){
      die("prepare() fail eliminar: ". $this->cone->error);
      return 0;
    }
    $stmt->bind_param('s',$language_id);
    $stmt->execute();
    $stmt->close();
    return 1;
  }// end to delete

  function getLocation($id){
    $sql="SELECT * FROM locations WHERE id=$id";
    $result = $this->cone->query($sql);
    $array=array();
    while($row = $result->fetch_assoc()){
      $array[]=array(
        'gpslat'=>$row['gpslat'],
        'gpslong'=>$row['gpslong'],
        'gpszoom'=>$row['gpszoom'],
        'id'=> $row['id'],
        'country_id'=> $row['country_id']
      );
    }//fin del while
     if($result->num_rows > 0){
      $result->close();
      return json_encode($array);
     }
    $this->close();
    return false;
  }// fin de getLoction

  function getLaguage($id){
    $sql="SELECT * FROM locationdetails WHERE location_id=$id";
    $result = $this->cone->query($sql);
    $array=array();
    while($row = $result->fetch_assoc()){
      $array[]=array(
        'location_id'=>$row['location_id'],
        'language_id'=>$row['language_id'],
        'name'=>$row['name'],
        'description'=> $row['description'],
        'enabled'=>$row['enabled']
      );
    }//fin del while
     if($result->num_rows > 0){
      $result->close();
      return json_encode($array);
     }
    $result->close();
    return false;
  }// fin de getCountry

  function getMedia($id){
    $sql="SELECT * FROM location_media WHERE location_id=$id";
    $result = $this->cone->query($sql);
    $array=array();
    while($row = $result->fetch_assoc()){
      $array[]=array(
        'location_id'=>$row['location_id'],
        'media_id'=>$row['media_id'],
        'template_id'=>$row['template_id'],
        'position'=>$row['position']
      );
    }//fin del while
     if($result->num_rows > 0){
      $result->close();
      return json_encode($array);
     }
    $result->close();
    return -1;
  }// fin de getMedia


  function updateLocation($id,$gpslat,$gpslong,$gpszoom,$media_id,$template_id,$position){
     $stmt=$this->cone->prepare("UPDATE locations SET gpslat=?,gpslong=?,gpszoom=? WHERE id=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        echo 0;
      }
      $stmt->bind_param('ssii',$gpslat,$gpslong,$gpszoom,$id);
      $stmt->execute();
      $stmt->close();
      $stmt=$this->cone->prepare("UPDATE location_media SET media_id=?,template_id=?,position=? WHERE location_id=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        echo 0;
      }
      $stmt->bind_param('iiii',$media_id,$template_id,$position,$id);
      $stmt->execute();
      $stmt->close();
      return true;
  }//end to updateCountry

   function updateLocationDetails($location_id,$language_id,$name,$description){
      $stmt=$this->cone->prepare("UPDATE locationdetails SET name=?,description=? WHERE location_id=? AND language_id=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        echo 0;
      }
      $stmt->bind_param('ssii',$name,$description,$location_id,$language_id);
      $stmt->execute();
      $stmt->close();
      return true;
  }// end to updateCountryDetails

   function deleteLocation($id){
    $stmt=$this->cone->prepare("DELETE FROM location_media WHERE location_id=?");
    if($stmt === FALSE){
      die("prepare() fail eliminar: ". $this->cone->error);
      return 0;
    }
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->close();

    $stmt=$this->cone->prepare("DELETE FROM locationdetails WHERE location_id=?");
    if($stmt === FALSE){
      die("prepare() fail eliminar: ". $this->cone->error);
      return 0;
    }
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->close();

    $stmt=$this->cone->prepare("DELETE FROM locations WHERE id=?");
    if($stmt === FALSE){
      die("prepare() fail eliminar: ". $this->cone->error);
      return 0;
    }
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->close();
    return "eliminar completo";
  }// end to delete

  function getCountries(){
    $sql="SELECT country_id,name FROM countrydetails WHERE language_id=1";
    $result = $this->cone->query($sql);
    $array=array();
    while($row = $result->fetch_assoc()){
      $array[]=array(
        'country_id'=>$row['country_id'],
        'name'=>$row['name']
        );
    }//fin del while
     if($result->num_rows > 0){
      $result->close();
      return json_encode($array);
     }
    $result->close();
    return false;
  }// end to getCountries

  function addLocation($country_id,$gpslat,$gpslong,$gpszoom,$enable,$media_id,$template_id,$position){

     $stmt= $this->cone->prepare("INSERT INTO locations(country_id,gpslat,gpslong,gpszoom,enabled) VALUES(?,?,?,?,?)");
    if($stmt === FALSE){
      die("prepare() fail: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('iiiii',$country_id,$gpslat,$gpslong,$gpszoom,$enable);
    $stmt->execute();
    $stmt->close();
    //return true;
    $sql="SELECT (MAX(id)) AS id FROM locations";
    $result = $this->cone->query($sql);
    $array=array();
    while($row = $result->fetch_assoc()){
              $stmt= $this->cone->prepare("INSERT INTO location_media(location_id,media_id,template_id,position) VALUES(?,?,?,?)");
            if($stmt === FALSE){
              die("prepare() fail: ". $this->cone->error);
              return false;
            }
            $stmt->bind_param('iiii',$row['id'],$media_id,$template_id,$position);
            $stmt->execute();
            $stmt->close();
            $array[]=array('location_id'=>$row['id']);
    }//fin del while
    if($result->num_rows > 0){
      $result->close();
      return json_encode($array);
     }

    $result->close();
    return false;
  }//end to addLocation
  
  function addLocationDetails($location_id,$language_id,$name,$description,$enabled){
    $stmt= $this->cone->prepare("INSERT INTO locationdetails(location_id,language_id,name,description,enabled) VALUES(?,?,?,?,?)");
    if($stmt === FALSE){
      die("prepare() fail: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('iissi',$location_id,$language_id,$name,$description,$enabled);
    $stmt->execute();
    $stmt->close();
    return 1;
  }//end to addCountryDetails

}// fin de la clase
 ?>
