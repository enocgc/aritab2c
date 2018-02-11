<?php

require_once ("../includes/conexion.php");
require_once ("../includes/constantes.php");
 class Ocupations extends Conexion
 {

	public function __construct(){
     parent::__construct(__HOST__, __USER__, __PASSWD__, __DB_NAME__);
	}//fin del constructor


  function deleteOcupation($id){
      $stmt=$this->cone->prepare("DELETE FROM occupations WHERE id=?");
      if($stmt === FALSE){
        die("prepare() fail eliminar: ". $this->cone->error);
        return 0;
      }
      $stmt->bind_param('s',$id);
      $stmt->execute();
      $stmt->close();
      return 1;
    }# fin del metodo eliminar.

    function editOcupation($id,$persons){
      $stmt=$this->cone->prepare("UPDATE occupations SET persons=? WHERE id=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        echo 0;
      }
      $stmt->bind_param('ss',$persons,$id);
      //echo "id ".$id."idl ".$language_id."$name ".$name."$description ".$description;
      $stmt->execute();
      $stmt->close();
      echo 1;
    }# fin del metodo modificar.

    function editOcupationDetails($id,$language_id,$description){
      $stmt=$this->cone->prepare("UPDATE occupationdetails SET description=? WHERE occupation_id=? AND language_id=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        echo 0;
      }
      $stmt->bind_param('sss',$description,$id,$language_id);
      //echo "id ".$id."idl ".$language_id."$name ".$name."$description ".$description;
      $stmt->execute();
      $stmt->close();
      echo 1;
    }# fin del metodo modificar.

//funcion para insertar y obtener id
function addOcupation($id,$persons){
  $stmt= $this->cone->prepare("INSERT INTO occupations(id,persons) VALUES(?,?)");
  if($stmt === FALSE){
    die("prepare() fail: ". $this->cone->error);
    return false;
  }
  $stmt->bind_param('ss',$id,$persons);
  $stmt->execute();
  $stmt->close();
  return true;
}#fin del metodo incluir
//funcion para agregar idiomas al detale del tag
function addOcupationDetails($id,$language_id,$description){
  $stmt= $this->cone->prepare("INSERT INTO occupationdetails(occupation_id,language_id,description) VALUES(?,?,?)");
  if($stmt === FALSE){
    die("prepare() fail: ". $this->cone->error);
    return false;
  }
  $stmt->bind_param('sss',$id,$language_id,$description);
  $stmt->execute();
  //echo "aqui estamos"." id ".$id." lang ".$language_id." name ".$name." desc ".$description." stm ".  $stmt->bind_param('iiss',$id,$language_id,$name,$description);
  $stmt->close();

  return true;
}
    function getOcupation(){
      //SELECT a.name,a.id, b.startdate,b.enddate FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id
      $sql="SELECT a.id, b.occupation_id,b.description,b.language_id,a.persons FROM occupations AS a, occupationdetails AS b WHERE a.id=b.occupation_id and b.language_id=1  ORDER BY a.id";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'id'=>$row['id'],
          'occupation_id'=>$row['occupation_id'],
          'language_id'=>$row['language_id'],
          'description'=> $row['description'],
          'persons'=>$row['persons']
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
    function getOcupationtoModal($id,$idlan,$short){

      $sql="SELECT a.id, b.description,b.language_id,a.persons,c.short FROM occupations AS a, occupationdetails AS b, languages AS c WHERE  c.short='$short' AND '$id'=b.occupation_id AND '$id'=a.id AND '$idlan'=b.language_id    ORDER BY c.id";

      //  $sql="SELECT * FROM languages where id='$id'";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'id'=>$row['id'],
          'language_id'=>$row['language_id'],
          'description'=> $row['description'],
          'persons'=>$row['persons'],
          'short'=>$row['short']
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
