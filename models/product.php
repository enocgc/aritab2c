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


    function getProducts(){
      //SELECT a.name,a.id, b.startdate,b.enddate FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id
      $sql="SELECT a.id, b.product_id,b.name,b.language_id,a.service_id,a.country_id,a.location_id,a.enabled,c.name AS namecountrie,d.name As namelocation FROM products AS a, productdetails AS b,countrydetails As c,locationdetails AS d
      WHERE a.id=b.product_id AND b.language_id=1 AND c.language_id=1 AND d.language_id=1 AND c.country_id=a.country_id AND d.location_id=a.location_id ORDER BY a.id";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'id'=>$row['id'],
          'product_id'=>$row['product_id'],
          'language_id'=>$row['language_id'],
          'name'=> $row['name'],
          'service_id'=>$row['service_id'],
          'country_id'=>$row['country_id'],
          'location_id'=>$row['location_id'],
          'enabled'=>$row['enabled'],
          'namecountry'=>$row['namecountrie'],
          'namelocation'=>$row['namelocation']
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

    function getProductsEnabled(){
      //SELECT a.name,a.id, b.startdate,b.enddate FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id
      $sql="SELECT a.id, b.product_id,b.name,b.language_id,a.service_id,a.country_id,a.location_id,a.enabled,c.name AS namecountrie,d.name As namelocation FROM products AS a, productdetails AS b,countrydetails As c,locationdetails AS d
      WHERE a.id=b.product_id AND b.language_id=1 AND c.language_id=1 AND d.language_id=1 AND c.country_id=a.country_id AND d.location_id=a.location_id AND a.enabled=1 ORDER BY a.id";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'id'=>$row['id'],
          'product_id'=>$row['product_id'],
          'language_id'=>$row['language_id'],
          'name'=> $row['name'],
          'service_id'=>$row['service_id'],
          'country_id'=>$row['country_id'],
          'location_id'=>$row['location_id'],
          'enabled'=>$row['enabled'],
          'namecountry'=>$row['namecountrie'],
          'namelocation'=>$row['namelocation']
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


    function getProductAcomodation($id){
      //SELECT a.name,a.id, b.startdate,b.enddate FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id
      $sql="SELECT a.id, b.product_id,b.name,b.language_id,a.service_id,a.country_id,a.location_id,a.enabled,c.name AS namecountrie,d.name As namelocation FROM products AS a, productdetails AS b,countrydetails As c,locationdetails AS d
      WHERE a.id=b.product_id AND b.language_id=1 AND c.language_id=1 AND d.language_id=1 AND c.country_id=a.country_id AND d.location_id=a.location_id AND a.enabled=1 AND a.service_id=2 AND a.location_id=$id  ORDER BY a.id";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'id'=>$row['id'],
          'product_id'=>$row['product_id'],
          'language_id'=>$row['language_id'],
          'name'=> $row['name'],
          'service_id'=>$row['service_id'],
          'country_id'=>$row['country_id'],
          'location_id'=>$row['location_id'],
          'enabled'=>$row['enabled'],
          'namecountry'=>$row['namecountrie'],
          'namelocation'=>$row['namelocation']
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

    function getProductsEnabledidP($id){
      //SELECT a.name,a.id, b.startdate,b.enddate FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id
      $sql="SELECT a.id, b.product_id,b.name,b.language_id,a.service_id,a.country_id,a.location_id,a.enabled,c.name AS namecountrie,d.name As namelocation FROM products AS a, productdetails AS b,countrydetails As c,locationdetails AS d
      WHERE a.id=b.product_id AND b.language_id=1 AND c.language_id=1 AND d.language_id=1 AND c.country_id=a.country_id AND d.location_id=a.location_id AND a.enabled=1 AND a.location_id=$id AND a.service_id=3 ORDER BY a.id";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'id'=>$row['id'],
          'product_id'=>$row['product_id'],
          'language_id'=>$row['language_id'],
          'name'=> $row['name'],
          'service_id'=>$row['service_id'],
          'country_id'=>$row['country_id'],
          'location_id'=>$row['location_id'],
          'enabled'=>$row['enabled'],
          'namecountry'=>$row['namecountrie'],
          'namelocation'=>$row['namelocation']
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


    function getLaguage($id){
      $sql="SELECT * FROM productdetails WHERE product_id=$id";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'product_id'=>$row['product_id'],
          'language_id'=>$row['language_id'],
          'name'=>$row['name'],
          'description'=> $row['description']
        );
      }//fin del while
       if($result->num_rows > 0){
        return json_encode($array);
       }
      $this->close();
      return false;
    }// fin de product

    function getMedia($id){

      $sql="SELECT * FROM product_media WHERE product_id=$id";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'product_id'=>$row['product_id'],
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

    function getProduct($id){
      $sql="SELECT * FROM products WHERE id=$id";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'service_id'=>$row['service_id'],
          'country_id'=>$row['country_id'],
          'location_id'=>$row['location_id'],
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

   function updateProduct($id,$service_id,$country_id,$location_id,$gpslat,$gpslong,$gpszoom,$media_id,$template_id,$position){
      $stmt=$this->cone->prepare("UPDATE products SET service_id=?,country_id=?,location_id=?,gpslat=?,gpslong=?,gpszoom=? WHERE id=?");
       if($stmt === FALSE){
         die("prepare() fail modificar: ". $this->cone->error);
         echo 0;
       }
       $stmt->bind_param('sssssii',$service_id,$country_id,$location_id,$gpslat,$gpslong,$gpszoom,$id);
       $stmt->execute();
       $stmt->close();


       $stmt=$this->cone->prepare("UPDATE product_media SET media_id=?,template_id=?,position=? WHERE product_id=?");
       if($stmt === FALSE){
         die("prepare() fail modificar: ". $this->cone->error);
         echo 0;
       }
       $stmt->bind_param('iiii',$media_id,$template_id,$position,$id);
       $stmt->execute();
       $stmt->close();
       return true;
   }//end to updateCountry

   function updateProductDetails($product_id,$language_id,$name,$description){
       $stmt=$this->cone->prepare("UPDATE productdetails SET name=?,description=? WHERE product_id=? AND language_id=?");
       if($stmt === FALSE){
         die("prepare() fail modificar: ". $this->cone->error);
         echo 0;
       }
       $stmt->bind_param('ssss',$name,$description,$product_id,$language_id);
       $stmt->execute();
       $stmt->close();
       return true;
   }// end to updateCountryDetails
}

?>
