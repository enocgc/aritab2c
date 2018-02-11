<?php

require_once ("../includes/conexion.php");
require_once ("../includes/constantes.php");
 class Transports extends Conexion
 {

	public function __construct(){
     parent::__construct(__HOST__, __USER__, __PASSWD__, __DB_NAME__);
	}//fin del constructor

  function changeEnabled($id,$enabled){
    $stmt=$this->cone->prepare("UPDATE transporttypes SET enabled=? WHERE id=?");
    if($stmt === FALSE){
      die("prepare() fail modificar: ". $this->cone->error);
      return false;
    }
    $stmt->bind_param('ss',$enabled,$id);
    $stmt->execute();
    $stmt->close();
    return true;
  }# fin del metodo modificar.


  function deleteTransport($id){
      $stmt=$this->cone->prepare("DELETE FROM transporttypes WHERE id=?");
      if($stmt === FALSE){
        die("prepare() fail eliminar: ". $this->cone->error);
        return 0;
      }
      $stmt->bind_param('i',$id);
      $stmt->execute();
      $stmt->close();
      return 1;
    }# fin del metodo eliminar.

    function editTransport($id,$language_id,$name){
      $stmt=$this->cone->prepare("UPDATE transporttypedetail SET name=? WHERE transporttype_id=? AND language_id=?");
      //echo "id ".$id." lang ".$language_id." name".$name;
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        echo false;
      }
      $stmt->bind_param('sss',$name,$id,$language_id);
      //echo "id ".$id."idl ".$language_id."$name ".$name."$description ".$description;
      $stmt->execute();
      $stmt->close();
      echo true;
    }# fin del metodo modificar.


//funcion para insertar y obtener id
function addTransport(){
  $enabled=1;
  $stmt= $this->cone->prepare("INSERT INTO transporttypes(enabled) VALUES(?)");

  if($stmt === FALSE){
    die("prepare() fail: ". $this->cone->error);
    return false;
  }
  $stmt->bind_param('s',$enabled);
  $stmt->execute();
  $stmt->close();
  //return true;
  $sql="SELECT (MAX(id)) AS id,enabled As enabled  FROM transporttypes";
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
  //return $variable;
 return false;
}
//funcion para agregar idiomas al detale del tag
function addTransportDetails($id,$language_id,$name){
  $stmt= $this->cone->prepare("INSERT INTO transporttypedetail(transporttype_id,language_id,name) VALUES(?,?,?)");
  if($stmt === FALSE){
    die("prepare() fail: ". $this->cone->error);
    return false;
  }
  $stmt->bind_param('iis',$id,$language_id,$name);
  $stmt->execute();
  //echo "aqui estamos"." id ".$id." lang ".$language_id." name ".$name." desc ".$description." stm ".  $stmt->bind_param('iiss',$id,$language_id,$name,$description);
  $stmt->close();

  return true;
}
    function getTransport(){
      //SELECT a.name,a.id, b.startdate,b.enddate FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id
      $sql="SELECT a.id,a.enabled, b.transporttype_id,b.name,b.language_id,a.default FROM transporttypes AS a, transporttypedetail AS b WHERE a.id=b.transporttype_id and b.language_id=1  ORDER BY a.id";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'id'=>$row['id'],
          'transporttype_id'=>$row['transporttype_id'],
          'language_id'=>$row['language_id'],
          'name'=> $row['name'],
          'default'=>$row['default'],
          'enabled'=>$row['enabled']
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
    function getTransporttoModal($id,$idlan,$short){

      $sql="SELECT a.id,a.enabled, b.transporttype_id,b.name,b.language_id,c.short FROM transporttypes AS a, transporttypedetail AS b, languages AS c WHERE  c.short='$short' AND $id=b.transporttype_id AND '$idlan'=b.language_id    ORDER BY c.id";
      //  $sql="SELECT * FROM languages where id='$id'";
    //  echo "short ".$short." id lang ".$idlan." id tag ".$id;
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'id'=>$row['id'],
          'transporttype_id'=>$row['transporttype_id'],
          'enabled'=>$row['enabled'],
          'language_id'=>  $row['language_id'],
          'name'=> $row['name'],
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

}

?>
