<?php
require_once ("../includes/conexion.php");
require_once ("../includes/constantes.php");
 class Countries extends Conexion
 {

  public function __construct(){
     parent::__construct(__HOST__, __USER__, __PASSWD__, __DB_NAME__);
  }//fin del constructor

  function getCountries(){

    $sql="SELECT a.id, b.language_id,b.name,b.description,a.gpslat,a.gpszoom,a.enabled,a.gpslong FROM countries AS a,countrydetails AS b WHERE b.language_id=1 AND b.country_id=a.id ORDER BY a.id";
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
    $result->close();
    //return $variable;
   return false;
  }# fin del metodo consulta

  function changeEnabled($id,$enabled){
    $stmt=$this->cone->prepare("UPDATE countries SET enabled=? WHERE id=?");
    if($stmt === FALSE){
      die("prepare() fail modificar: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('ss',$enabled,$id);
    $stmt->execute();
    $stmt->close();
    return true;
  }# fin del metodo modificar.

  function deleteCountry($id){
    $stmt=$this->cone->prepare("DELETE FROM countries WHERE id=?");
    if($stmt === FALSE){
      die("prepare() fail eliminar: ". $this->cone->error);
      return 0;
    }
    $stmt->bind_param('s',$id);
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

  function addCountryDetails($country_id,$language_id,$name,$description,$enabled){
    $stmt= $this->cone->prepare("INSERT INTO countrydetails(country_id,language_id,name,description,enabled) VALUES(?,?,?,?,?)");
    if($stmt === FALSE){
      die("prepare() fail: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('iissi',$country_id,$language_id,$name,$description,$enabled);
    $stmt->execute();
    $stmt->close();
    return 1;
  }//end to addCountryDetails

  function addCountryMedia($country_id,$media_id,$template_id,$position){
    $stmt= $this->cone->prepare("INSERT INTO country_media(country_id,media_id,template_id,position) VALUES(?,?,?,?)");
    if($stmt === FALSE){
      die("prepare() fail: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('iiii',$country_id,$media_id,$template_id,$position);
    $stmt->execute();
    $stmt->close();
    return 1;
  }// end to addCountryMedia

function updateCountryMedia($country_id,$media_id,$template_id,$position){
   $stmt= $this->cone->prepare("INSERT INTO country_media(country_id,media_id,template_id,position) VALUES(?,?,?,?) ON DUPLICATE KEY UPDATE country_id=?");
   if($stmt === FALSE){
     die("prepare() fail: ". $this->cone->error);
     return false;
   }
   $stmt->bind_param('iiiii',$country_id,$media_id,$template_id,$position,$country_id);
   $stmt->execute();
   $stmt->close();
}// end to addCountryMedia

  function getCountry($id){
    $sql="SELECT * FROM countries WHERE id=$id";
    $result = $this->cone->query($sql);
    $array=array();
    while($row = $result->fetch_assoc()){
      $array[]=array(
        'gpslat'=>$row['gpslat'],
        'gpslong'=>$row['gpslong'],
        'gpszoom'=>$row['gpszoom'],
        'id'=> $row['id']
      );
    }//fin del while
     if($result->num_rows > 0){
      return json_encode($array);
     }
    $this->close();
    return false;
  }// fin de getCountry

  function getLaguage($id){
    $sql="SELECT * FROM countrydetails WHERE country_id=$id";
    $result = $this->cone->query($sql);
    $array=array();
    while($row = $result->fetch_assoc()){
      $array[]=array(
        'country_id'=>$row['country_id'],
        'language_id'=>$row['language_id'],
        'name'=>$row['name'],
        'description'=> $row['description'],
        'enabled'=>$row['enabled']
      );
    }//fin del while
     if($result->num_rows > 0){
      return json_encode($array);
     }
    $this->close();
    return false;
  }// fin de getCountry

  function getMedia($id){
    $sql="SELECT * FROM country_media WHERE country_id=$id";
    $result = $this->cone->query($sql);
    $array=array();
    while($row = $result->fetch_assoc()){
      $array[]=array(
        'country_id'=>$row['country_id'],
        'media_id'=>$row['media_id'],
        'template_id'=>$row['template_id'],
        'position'=>$row['position']
      );
    }//fin del while
     if($result->num_rows > 0){
      return json_encode($array);
     }
    $result->close();
    return true;
  }// fin de getCountry

  function updateCountry($id,$gpslat,$gpslong,$gpszoom){
     $stmt=$this->cone->prepare("UPDATE countries SET gpslat=?,gpslong=?,gpszoom=? WHERE id=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        echo 0;
      }
      $stmt->bind_param('ssii',$gpslat,$gpslong,$gpszoom,$id);
      $stmt->execute();
      $stmt->close();

      return true;
  }//end to updateCountry
  function updateCountryDetails($country_id,$language_id,$name,$description){
      $stmt=$this->cone->prepare("UPDATE countrydetails SET name=?,description=? WHERE country_id=? AND language_id=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        echo 0;
      }
      $stmt->bind_param('ssii',$name,$description,$country_id,$language_id);
      $stmt->execute();
      $stmt->close();
      return true;
  }// end to updateCountryDetails
}// fin de la clase
 ?>
