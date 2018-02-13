<?php

require_once ("../includes/conexion.php");
require_once ("../includes/constantes.php");
 class Languages extends Conexion
 {

	public function __construct(){
     parent::__construct(__HOST__, __USER__, __PASSWD__, __DB_NAME__);
	}//fin del constructor
  function addLanguage($name,$short,$icon,$enabled){
      $stmt= $this->cone->prepare("INSERT INTO languages(name,short,icon,enabled) VALUES(?,?,?,?)");

      if($stmt === FALSE){
        die("prepare() fail: ". $this->cone->error);
        return false;
      }
      $stmt->bind_param('ssss',$name,$short,$icon,$enabled);
      $stmt->execute();
      $stmt->close();
      return true;
    }#fin del metodo incluirusuario


  function deleteLanguage($id){
      $stmt=$this->cone->prepare("DELETE FROM languages WHERE id=?");
      if($stmt === FALSE){
        die("prepare() fail eliminar: ". $this->cone->error);
        return false;
      }
      $stmt->bind_param('s',$id);
      $stmt->execute();
      $stmt->close();
      return true;
    }# fin del metodo eliminar.

    function editLanguage($id,$name,$short,$icon){
      echo "id ".$id."name ".$name."short ".$short."icon ".$icon;
      $stmt=$this->cone->prepare("UPDATE languages SET name=?,short=?,icon=? WHERE id=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        return false;
      }
      $stmt->bind_param('ssss',$name,$short,$icon,$id);
      $stmt->execute();
      $stmt->close();
      return true;
    }# fin del metodo modificar.

    function changeEnabled($id,$enabled){
      $stmt=$this->cone->prepare("UPDATE languages SET enabled=? WHERE id=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        return false;
      }
      $stmt->bind_param('ss',$enabled,$id);
      $stmt->execute();
      $stmt->close();
      return true;
    }# fin del metodo modificar.


    function getLanguage(){
      $sql = "SELECT * FROM `languages`";
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


    //funcion obtener usuario por id
    function getLanguagetoModal($id){
      $sql="SELECT * FROM languages where id='$id'";
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
   }# fin del metodo consulta byid

}

?>
