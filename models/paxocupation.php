<?php

require_once ("../includes/conexion.php");
require_once ("../includes/constantes.php");
 class Paxs extends Conexion
 {

	public function __construct(){
     parent::__construct(__HOST__, __USER__, __PASSWD__, __DB_NAME__);
	}//fin del constructor


  function deletePaxOcupation($id){
      $stmt=$this->cone->prepare("DELETE FROM paxoccupations WHERE id=?");
      if($stmt === FALSE){
        die("prepare() fail eliminar: ". $this->cone->error);
        return 0;
      }
      $stmt->bind_param('s',$id);
      $stmt->execute();
      $stmt->close();
      return 1;
    }# fin del metodo eliminar.

    function editTags($id,$language_id,$name,$description){
      $stmt=$this->cone->prepare("UPDATE tagdetails SET name=?,description=? WHERE tag_id=? AND language_id=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        echo 0;
      }
      $stmt->bind_param('ssss',$name,$description,$id,$language_id);
      //echo "id ".$id."idl ".$language_id."$name ".$name."$description ".$description;
      $stmt->execute();
      $stmt->close();
      echo 1;
    }# fin del metodo modificar.

    function changeEnabled($id,$enabled){
      $stmt=$this->cone->prepare("UPDATE paxoccupations SET enabled=? WHERE id=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        return false;
      }
      $stmt->bind_param('ss',$enabled,$id);
      $stmt->execute();
      $stmt->close();
      return true;
    }# fin del metodo modificar.

//funcion para insertar y obtener id
function addPaxOcupation($pax,$occupation_id,$enabled){
  $stmt= $this->cone->prepare("INSERT INTO paxoccupations(pax,occupation_id,enabled) VALUES(?,?,?)");

  if($stmt === FALSE){
    die("prepare() fail: ". $this->cone->error);
    return false;
  }
  $stmt->bind_param('sss',$pax,$occupation_id,$enabled);
  $stmt->execute();
  $stmt->close();

}


    function getPaxOcupation(){
      //SELECT a.name,a.id, b.startdate,b.enddate FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id
      $sql="SELECT * FROM paxoccupations";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'id'=>$row['id'],
          'pax'=>$row['pax'],
          'occupation_id'=>$row['occupation_id'],
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

    function getTagsEnabled(){
      //SELECT a.name,a.id, b.startdate,b.enddate FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id
      $sql="SELECT a.id, b.tag_id,b.name,b.description,a.enabled FROM tags AS a, tagdetails AS b WHERE a.id=b.tag_id and b.language_id=1 and a.enabled=1  ORDER BY a.id";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'id'=>$row['id'],
          'tag_id'=>$row['tag_id'],
          'enabled'=>$row['enabled'],
          'name'=> $row['name'],
          'description'=>$row['description']
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
    function getTagtoModal($id,$idlan,$short){

      $sql="SELECT a.id,a.enabled, b.language_id,b.name,b.description,c.short FROM tags AS a, tagdetails AS b, languages AS c WHERE  c.short='$short' AND $id=a.id AND '$idlan'=b.language_id    ORDER BY c.id";
      //  $sql="SELECT * FROM languages where id='$id'";
    //  echo "short ".$short." id lang ".$idlan." id tag ".$id;
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'id'=>$row['id'],
          'enabled'=>$row['enabled'],
          'language_id'=>  $row['language_id'],
          'name'=> $row['name'],
          'short'=> $row['short'],
          'description'=> $row['description']
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
