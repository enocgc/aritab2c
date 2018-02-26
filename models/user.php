<?php

require_once ("../includes/conexion.php");
require_once ("../includes/constantes.php");
 class Users extends Conexion
 {

	public function __construct(){
     parent::__construct(__HOST__, __USER__, __PASSWD__, __DB_NAME__);
	}//fin del constructor
  function addUser($name,$user,$passwordEncript,$email,$phone,$country,$company,$enabled){
    $sql="SELECT * FROM user where name='$name'";
    $result = $this->cone->query($sql);
    $array=array();
    //return "texto";
     if($result->num_rows > 0){

       return 0;
     }
     //return $variable;
      $stmt= $this->cone->prepare("INSERT INTO user(name,user,password,email,phone,country,company,enabled) VALUES(?,?,?,?,?,?,?,?)");

      if($stmt === FALSE){
        die("prepare() fail: ". $this->cone->error);
        return false;
      }
      $stmt->bind_param('ssssssss',$name,$user,$passwordEncript,$email,$phone,$country,$company,$enabled);
      $stmt->execute();
      $stmt->close();
      return 1;
    }#fin del metodo incluirusuario


  function deleteUser($id){
      $stmt=$this->cone->prepare("DELETE FROM user WHERE iduser=?");
      if($stmt === FALSE){
        die("prepare() fail eliminar: ". $this->cone->error);
        return false;
      }
      $stmt->bind_param('s',$id);
      $stmt->execute();
      $stmt->close();
      return true;
    }# fin del metodo eliminar.

    function editUser($name,$user,$email,$phone,$country,$company,$iduser){
      $stmt=$this->cone->prepare("UPDATE user SET name=?,user=?,email=?,phone=?,country=?,company=? WHERE iduser=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        return false;
      }
      $stmt->bind_param('sssssss',$name,$user,$email,$phone,$country,$company,$iduser);
      $stmt->execute();
      $stmt->close();
      return true;
    }# fin del metodo modificar.
    function changeEnabled($iduser,$enabled){
      $stmt=$this->cone->prepare("UPDATE user SET enabled=? WHERE iduser=?");
      if($stmt === FALSE){
        die("prepare() fail modificar: ". $this->cone->error);
        return false;
      }
      $stmt->bind_param('ss',$enabled,$iduser);
      $stmt->execute();
      $stmt->close();
      return true;
    }# fin del metodo modificar.
//funcion para cambiar el password
function changePass($iduser,$newPassEnc,$actualPassEnc){
  $sql="SELECT * FROM user where iduser='$iduser' and password='$actualPassEnc'";
  $result = $this->cone->query($sql);
  $result = $this->cone->query($sql);
  $array=array();
  //return "texto";
   if($result->num_rows > 0){
     //UPDATE user SET password='enoc' WHERE iduser='30'
     $sql="UPDATE user SET password='$newPassEnc' WHERE iduser='$iduser'";
     $result = $this->cone->query($sql);
     return 1;
   }
   $this->close();
   //return $variable;
   return 0;
   //return false;
}

    function getUser(){
      $sql="SELECT * FROM user";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'iduser'=>$row['iduser'],
          'name'=>$row['name'],
          'user'=>$row['user'],
          'password'=>  $row['password'],
          'email'=> $row['email'],
          'phone'=> $row['phone'],
          'country'=> $row['country'],
          'company'=> $row['company'],
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
    function getUsertoModal($iduser){
      $sql="SELECT * FROM user where iduser='$iduser'";
      $result = $this->cone->query($sql);
      $array=array();
      while($row = $result->fetch_assoc()){
        $array[]=array(
          'iduser'=>$row['iduser'],
          'name'=>$row['name'],
          'user'=>$row['user'],
          'password'=>  $row['password'],
          'email'=> $row['email'],
          'phone'=> $row['phone'],
          'country'=> $row['country'],
          'company'=> $row['company'],
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
