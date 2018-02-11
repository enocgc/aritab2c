<?php
/**
 *
 */
 //clase concexion para utilizar en todos los llamados a la db
 /**
  *
  */
class Conexion
{
  protected $cone;
  public function __construct($host, $user, $password, $dbname)
  {
    $this->cone = new mysqli($host, $user, $password, $dbname);
  //  echo "Conexion realizada";
    if(mysqli_connect_errno()){
    //  echo "error ".mysqli_connect_error();
      die("falló la conexion");
    }
  }
  function cerrar(){
    //echo "conexion cerrada";
    $this->cone->close();
  }
  function __destruct(){
    $this->cerrar();
  }
}

 ?>
