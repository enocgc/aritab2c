<?php

require_once ("../includes/conexion.php");
require_once ("../includes/constantes.php");
 class Seasons extends Conexion
 {

	public function __construct(){
     parent::__construct(__HOST__, __USER__, __PASSWD__, __DB_NAME__);
	}//fin del constructor
  function addSeason($name){
      $stmt= $this->cone->prepare("INSERT INTO seasons(name) VALUES(?)");

      if($stmt === FALSE){
        die("prepare() fail: ". $this->cone->error);
        return false;
      }
      $stmt->bind_param('s',$name);
      $stmt->execute();
      $stmt->close();
      return true;
    }#fin del metodo incluirusuario

    function addSeasonPeriods($id,$stardate,$enddate){
        $stmt= $this->cone->prepare("INSERT INTO seasonperiods(season_id,startdate,enddate) VALUES(?,?,?)");

        if($stmt === FALSE){
          die("prepare() fail: ". $this->cone->error);
          return false;
        }
        $stmt->bind_param('sss',$id,$stardate,$enddate);
        $stmt->execute();
        $stmt->close();
        return true;
      }#fin del metodo incluirusuario

  function deleteSeason($id){
      $stmt=$this->cone->prepare("DELETE FROM seasonperiods WHERE id=?");
      if($stmt === FALSE){
        die("prepare() fail eliminar: ". $this->cone->error);
        return false;
      }
      $stmt->bind_param('s',$id);
      $stmt->execute();
      $stmt->close();
      return true;
    }# fin del metodo eliminar.

    function editSeason($id,$season_id,$stardate,$enddate){
    //echo "id".$id." star ".$stardate." end ".$enddate;
      $stmt=$this->cone->prepare("UPDATE seasonperiods SET season_id=?,startdate=?,enddate=? WHERE id=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        return false;
      }
      $stmt->bind_param('ssss',$season_id,$stardate,$enddate,$id);
      $stmt->execute();
      $stmt->close();
      return true;
    }# fin del metodo modificar.



    function getSeason(){
      //SELECT a.name,a.id, b.startdate,b.enddate FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id
      $sql="SELECT a.name, b.startdate,b.enddate,b.season_id,b.id FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'name'=>$row['name'],
          'startdate'=>$row['startdate'],
          'enddate'=>  $row['enddate'],
          'id'=> $row['season_id'],
          'id2'=>$row['id']
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
    function getYears(){
      //SELECT a.name,a.id, b.startdate,b.enddate FROM seasons AS a, seasonperiods AS b WHERE a.id=b.season_id ORDER BY a.id
      $sql="SELECT * FROM seasons";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'name'=>$row['name'],
          'id'=> $row['id']

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
    function getSeasontoModal($id,$id2){
      $sql="SELECT a.name, b.startdate,b.enddate,b.id,b.season_id FROM seasons AS a, seasonperiods AS b WHERE '$id2'=b.id AND '$id'=a.id ORDER BY a.id";
      //  $sql="SELECT * FROM languages where id='$id'";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'name'=>$row['name'],
          'startdate'=>$row['startdate'],
          'enddate'=>  $row['enddate'],
          'id'=> $row['id'],
          'id2'=> $row['season_id']
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
