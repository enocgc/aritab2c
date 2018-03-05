<?php

require_once ("../includes/conexion.php");
require_once ("../includes/constantes.php");
class Package extends Conexion
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


  //funcion para insertar y obtener id
  function addPackage(){
    $enabled=1;
    $stmt= $this->cone->prepare("INSERT INTO packages(enabled) VALUES(?)");
    if($stmt === FALSE){
      die("prepare() fail: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('i',$enabled);
    $stmt->execute();
    $stmt->close();
    //return true;
    $sql="SELECT (MAX(id)) AS id ,enabled  FROM packages";
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
  }// end to package*/

  function addPackageDetails($package_id,$language_id,$name,$description){
    $stmt= $this->cone->prepare("INSERT IGNORE INTO packagedetails(package_id,language_id,name,description) VALUES(?,?,?,?)");
    if($stmt === FALSE){
      die("prepare() fail: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('iiss',$package_id,$language_id,$name,$description);
    $stmt->execute();
    $stmt->close();
    return 1;
  }//end to addPackageDetails
  //funcion para insertar el paquete transporte
  function addPackageTransport($package_id,$transporttype_id){
    $stmt= $this->cone->prepare("INSERT IGNORE INTO package_transportoptions(package_id,transporttype_id) VALUES(?,?)");
    if($stmt === FALSE){
      die("prepare() fail: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('ii',$package_id,$transporttype_id);
    $stmt->execute();
    $stmt->close();
    return 1;
  }
  //funcion para insertar el paquete tags
  function addPackageTag($package_id,$tag_id){
    $stmt= $this->cone->prepare("INSERT IGNORE INTO package_tags(package_id,tag_id) VALUES(?,?)");
    if($stmt === FALSE){
      die("prepare() fail: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('ii',$package_id,$tag_id);
    $stmt->execute();
    $stmt->close();
    return 1;
  }
  //funcion para agregar addPackageroute
  function addPackageroute($package_id,$location_id,$id_location,$position,$minnights,$acomodationid){
    $stmt= $this->cone->prepare("INSERT IGNORE INTO packageroutes(package_id,location_id,position,minnights) VALUES(?,?,?,?)");
    if($stmt === FALSE){
      die("prepare() fail: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('iiii',$package_id,$location_id,$position,$minnights);
    $stmt->execute();
    $stmt->close();
    $sql="SELECT (MAX(id)) AS id  FROM packageroutes";
    $result = $this->cone->query($sql);
    $array=array();
    while($row = $result->fetch_assoc()){
      $array[]=array(
        'id'=>$row['id'],
        'acomodationid'=>$acomodationid,
        'location_id'=>$location_id,
        'id_location'=>$id_location,
      );
    }//fin del while
    if($result->num_rows > 0){
      return json_encode($array);
    }
    $this->close();
    return false;
  }

  //funcion add addpackageroute_servicesAcomodation
  function addpackageroute_services($packageroute_id,$service_id,$quantity){
    $stmt= $this->cone->prepare("INSERT IGNORE INTO packageroute_services(packageroute_id,service_id,quantity) VALUES(?,?,?)");
    if($stmt === FALSE){
      die("prepare() fail: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('iii',$packageroute_id,$service_id,$quantity);
    $stmt->execute();
    $stmt->close();
    return 1;
  }//fin de addpackageroute_services

  //funcion add addpackageroute_products
  function addpackageroute_products($packageroutes,$service_id,$product_id,$day){
    $stmt= $this->cone->prepare("INSERT IGNORE INTO packageroute_products(packageroute_id,service_id,product_id,day) VALUES(?,?,?,?)");
    if($stmt === FALSE){
      die("prepare() fail: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('iiii',$packageroutes,$service_id,$product_id,$day);
    $stmt->execute();
    $stmt->close();
    return 1;
  }

}//fin

?>
