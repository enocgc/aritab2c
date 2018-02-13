<?php

require_once ("../includes/conexion.php");
require_once ("../includes/constantes.php");
 class Products extends Conexion
 {

	public function __construct(){
     parent::__construct(__HOST__, __USER__, __PASSWD__, __DB_NAME__);
	}//fin del constructor

  function changeEnabled($id,$enabled){
    $stmt=$this->cone->prepare("UPDATE products SET enabled=? WHERE id=?");
    if($stmt === FALSE){
      die("prepare() fail modificar: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('ss',$enabled,$id);
    $stmt->execute();
    $stmt->close();
    return true;
  }# fin del metodo modificar.

  function deleteProduct($id){
      $stmt=$this->cone->prepare("DELETE FROM products WHERE id=?");
      if($stmt === FALSE){
        die("prepare() fail eliminar: ". $this->cone->error);
        return 0;
      }
      $stmt->bind_param('i',$id);
      $stmt->execute();
      $stmt->close();
      return 1;
    }# fin del metodo eliminar.

    function editService($id,$language_id,$name){
      $stmt=$this->cone->prepare("UPDATE servicedetails SET name=? WHERE service_id=? AND language_id=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        echo 0;
      }
      $stmt->bind_param('sss',$name,$id,$language_id);
      //echo "id ".$id."idl ".$language_id."$name ".$name."$description ".$description;
      $stmt->execute();
      $stmt->close();
      echo 1;
    }# fin del metodo modificar.

    function getProduct(){
      //SELECT a.name,a.id, b.startdate,b.enddate FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id
      $sql="SELECT a.id, b.product_id,b.name,b.description,b.language_id,a.service_id,a.country_id,a.location_id,a.gpslat,a.gpslong,a.gpszoom,a.enabled FROM products AS a, productdetails AS b   WHERE a.id=b.product_id AND b.language_id=1  ORDER BY a.id";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'id'=>$row['id'],
          'product_id'=>$row['product_id'],
          'language_id'=>$row['language_id'],
          'name'=> $row['name'],
          'description'=>$row['description'],
          'service_id'=>$row['service_id'],
          'country_id'=>$row['country_id'],
          'location_id'=>$row['location_id'],
          'gpslat'=>$row['gpslat'],
          'gpslong'=>$row['gpslong'],
          'gpszoom'=>$row['gpszoom'],
          'enabled'=>$row['enabled'],
          'namecountry'=>'',
          'namelocation'=>''
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

    function getLanguage(){
      $sql="SELECT * FROM languages WHERE enabled=1";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'id'=>$row['id'],
          'name'=>$row['name'],
          'short'=>$row['short'],
          'icon'=>  $row['icon'],
          'enabled'=> $row['enabled']
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

    //funcion obtener Tag por id
    function getServicetoModal($id,$idlan,$short){

      $sql="SELECT a.id,a.bylocation,a.byitinerary, b.name,b.language_id,c.short FROM services AS a, servicedetails AS b, languages AS c WHERE  c.short='$short' AND $id=b.service_id AND '$idlan'=b.language_id    ORDER BY c.id";
      //  $sql="SELECT * FROM languages where id='$id'";
    //  echo "short ".$short." id lang ".$idlan." id tag ".$id;
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'id'=>$row['id'],
          'bylocation'=>$row['bylocation'],
          'language_id'=>  $row['language_id'],
          'name'=> $row['name'],
          'byitinerary'=> $row['byitinerary'],
          'short'=> $row['short']
        );
      }//fin del while
      //return "texto";
       if($result->num_rows > 0){
      return json_encode($array);
       }
       $this->close();
       //return $variable;
      return false;
   }# fin del metodo consulta byid

   function getNameCountry($id){
      $sql="SELECT name FROM countrydetails WHERE country_id=$id AND language_id=1";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'name'=>$row['name'],
          'id'=>$id
        );
      }//fin del while
       if($result->num_rows > 0){
        return json_encode($array);
       }
       $result->close();
        return false;
   }//end to ggetName

   function getNameLocation($id){
      $sql="SELECT name FROM locationdetails WHERE location_id=$id AND language_id=1";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'name'=>$row['name']
        );
      }//fin del while
       if($result->num_rows > 0){
        return json_encode($array);
       }
       $result->close();
        return false;
   }//end to ggetName

   function getService(){
     //SELECT a.name,a.id, b.startdate,b.enddate FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id
     $sql="SELECT a.id, b.service_id,b.name,b.language_id,a.bylocation,a.byitinerary FROM services AS a, servicedetails AS b WHERE a.id=b.service_id and b.language_id=1  ORDER BY a.id";
     $result = $this->cone->query($sql);
     $array=array();
     while($row = $result->fetch_assoc()){
       $array[]=array(
         'id'=>$row['id'],
         'service_id'=>$row['service_id'],
         'language_id'=>$row['language_id'],
         'name'=> $row['name'],
         'bylocation'=>$row['bylocation'],
         'byitinerary'=>$row['byitinerary']
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

   function getCountries(){
     $sql="SELECT a.id, b.language_id,b.name,b.description,a.gpslat,a.gpszoom,a.enabled,a.gpslong FROM countries AS a,countrydetails AS b WHERE b.language_id=1 AND b.country_id=a.id AND a.enabled=1 ORDER BY a.id";
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

   function getLocation(){
     $sql="SELECT a.id, b.language_id,b.name,b.description,a.enabled FROM locations AS a,locationdetails AS b WHERE b.language_id=1 AND b.location_id=a.id AND a.enabled=1 ORDER BY a.id";
     $result = $this->cone->query($sql);
     $array=array();
     while($row = $result->fetch_assoc()){
       $array[]=array(
         'language_id'=>$row['language_id'],
         'name'=>$row['name'],
         'description'=>$row['description'],
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
   //funcion para insertar y obtener id
   function addProduct($service_id,$country_id,$location_id,$gpslat,$gpslong,$gpszoom,$enabled){
     $stmt= $this->cone->prepare("INSERT INTO products(service_id,country_id,location_id,gpslat,gpslong,gpszoom,enabled) VALUES(?,?,?,?,?,?,?)");
     if($stmt === FALSE){
       die("prepare() fail: ". $this->cone->error);
       return false;
     }
     $stmt->bind_param('iiiiiii',$service_id,$country_id,$location_id,$gpslat,$gpslong,$gpszoom,$enabled);
     $stmt->execute();
     $stmt->close();
     //return true;
     $sql="SELECT (MAX(id)) AS id ,enabled  FROM products";
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
   }// end to addProduct*/
  function addProductDetails($product_id,$language_id,$name,$description){
     $stmt= $this->cone->prepare("INSERT INTO productdetails(product_id,language_id,name,description) VALUES(?,?,?,?)");
     if($stmt === FALSE){
       die("prepare() fail: ". $this->cone->error);
       return false;
     }
     $stmt->bind_param('iiss',$product_id,$language_id,$name,$description);
     $stmt->execute();
     $stmt->close();
     return 1;
   }//end to addCountryDetails

   function addProductMedia($product_id,$media_id,$template_id,$position){
     $stmt= $this->cone->prepare("INSERT INTO product_media(product_id,media_id,template_id,position) VALUES(?,?,?,?)");
     if($stmt === FALSE){
       die("prepare() fail: ". $this->cone->error);
       return false;
     }
     $stmt->bind_param('iiii',$product_id,$media_id,$template_id,$position);
     $stmt->execute();
     $stmt->close();
     return 1;
   }// end to addCountryMedia

}

?>
