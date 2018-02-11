<?php

session_start();

function logged_in(){
  return isset($_SESSION['USER']);
}


function verify_session(){
  if(!logged_in()){
    header("Location:../index.html");
    exit();
  }// if
}

 ?>
