<?php
$data =json_decode(file_get_contents("php://input"));
$action = $data->action;


require_once ("../models/user.php");
switch ($action) {
  case 1:
    # code
    $iduser = $data->iduser;
    $name = $data->name;
    $user = $data->user;
    $password = $data->password;
    $email = $data->email;
    $phone = $data->phone;
    $country = $data->country;
    $company = $data->company;
    $passwordEncript=md5($password);
    $bd = new Users();
    $enabled=1;
    $bd->addUser($name,$user,$passwordEncript,$email,$phone,$country,$company,$enabled);
    break;
  case 2:
      $iduser = $data->iduser;
      $bd = new Users();
      $bd->deleteUser($iduser);
    break;

  case 3:
    $bd = new Users();
    echo $bd->getUser();
  break;
  case 4:
  $iduser = $data->iduserE;
  $name = $data->nameE;
  $user = $data->userE;
  $email = $data->emailE;
  $phone = $data->phoneE;
  $country = $data->countryE;
  $company = $data->companyE;
  $passwordEncript=md5($password);
  $bd = new Users();
   $bd->editUser($name,$user,$email,$phone,$country,$company,$iduser);
  break;
  case 5:
  $iduser = $data->iduserF;
  $enabled = $data->enabledF;
    $bd = new Users();
    echo $bd->changeEnabled($iduser,$enabled);
  break;
  case 6:
  $iduser = $data->iduser;
    $bd = new Users();
    echo $bd->getUsertoModal($iduser);
  break;
  case 7:
  $iduser = $data->idUserE;
  $actualPass = $data->actualPass;
  $newPass = $data->newPass;
  $actualPassEnc=md5($actualPass);
  $newPassEnc=md5($newPass);
  $bd = new Users();
  echo  $bd->changePass($iduser,$newPassEnc,$actualPassEnc);

  break;
  default:
}




 ?>
