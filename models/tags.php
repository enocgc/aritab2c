<?php

require_once ("../includes/conexion.php");
require_once ("../includes/constantes.php");
 class Tags extends Conexion
 {

	public function __construct(){
     parent::__construct(__HOST__, __USER__, __PASSWD__, __DB_NAME__);
	}//fin del constructor


  function deleteTag($id){
      $stmt=$this->cone->prepare("DELETE FROM tags WHERE id=?");
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
      $stmt=$this->cone->prepare("UPDATE tags SET enabled=? WHERE id=?");
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
function addTag($enabled){
  $stmt= $this->cone->prepare("INSERT INTO tags(enabled) VALUES(?)");

  if($stmt === FALSE){
    die("prepare() fail: ". $this->cone->error);
    return false;
  }
  $stmt->bind_param('i',$enabled);
  $stmt->execute();
  $stmt->close();
  //return true;
  $sql="SELECT (MAX(id)) AS id ,enabled As enabled FROM tags";
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
function addTagDetails($id,$language_id,$name,$description){
  $stmt= $this->cone->prepare("INSERT INTO tagdetails(tag_id,language_id,name,description) VALUES(?,?,?,?)");
  if($stmt === FALSE){
    die("prepare() fail: ". $this->cone->error);
    return false;
  }
  $stmt->bind_param('iiss',$id,$language_id,$name,$description);
  $stmt->execute();
  //echo "aqui estamos"." id ".$id." lang ".$language_id." name ".$name." desc ".$description." stm ".  $stmt->bind_param('iiss',$id,$language_id,$name,$description);
  $stmt->close();

  return true;
}
    function getTags(){
      //SELECT a.name,a.id, b.startdate,b.enddate FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id
      $sql="SELECT a.id, b.tag_id,b.name,b.description,a.enabled FROM tags AS a, tagdetails AS b WHERE a.id=b.tag_id and b.language_id=1  ORDER BY a.id";
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
//echo "string".$id.$idlan.$short;
      $sql="SELECT a.id,a.enabled, b.language_id,b.name,b.description,c.short FROM tags AS a, tagdetails AS b, languages AS c WHERE  c.short='$short' AND a.id=b.tag_id AND $id=b.tag_id AND '$idlan'=b.language_id    ORDER BY c.id";
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
