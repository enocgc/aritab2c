<?php
require("session.php");
$_SESSION=array();
session_destroy();
session_start();
header("Location:../index.html");
 ?>
