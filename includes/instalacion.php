
<?php
include_once("constantes.php");

$conexion = mysqli_connect(__HOST__, __USER__, __PASSWD__);
$sql="CREATE DATABASE aritab2c";
$resultado = mysqli_query($conexion, $sql);
echo $resultado;
if ($resultado)
{echo "Nueva base de datos creada correctamente</br>";
}
else
{echo mysqli_error($conexion);}
$sql="use aritab2c";
$resultado = mysqli_query($conexion, $sql);
echo $resultado;
if ($resultado)
{
}
else
{echo mysqli_error($conexion);}
//crear tabla usuario
$sql="create table usuarios(
    idusuario int(2) not null,
    nombre varchar(300) not null,
    correo varchar(300) not null,
    password varchar(20) not null,
    telefono varchar(45) null,
    paisOrigen varchar(200) null,
    tipoUsuario int(1) not null,
    PRIMARY KEY (idusuario))";
$conexion = mysqli_connect(__HOST__, __USER__, __PASSWD__,__DB_NAME__);
$resultado = mysqli_query($conexion, $sql);
if ($resultado)
{echo "Tabla usuario creada correctamente</br>";
}
else
{echo mysqli_error($conexion);}
//crear tabla historial
$sql="create table historial(
idhistorial int not null  PRIMARY KEY auto_increment,
accion varchar(100) not null,
detalle varchar(400) not null,
idUsuario int(2) not null,
fecha varchar(100) not null,
FOREIGN KEY(idUsuario) REFERENCES usuarios(idusuario))";

$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla historial creada correctamente</br>";
}
else{
  echo "Error al crear historial</br>";
}

//crear tabla logs
$sql="create table logs(
idlogs int not null  PRIMARY KEY auto_increment,
idUsuario int(2) not null,
error varchar(400),
fecha varchar(100) not null,
FOREIGN KEY(idUsuario) REFERENCES usuarios(idusuario))";



$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla logs creada correctamente</br>";
}
else{
  echo "Error al crear tabla logs</br>";
}

//crear tabla countries
$sql="create table countries(
  id tinyint(3) unsigned not null  PRIMARY KEY auto_increment,
  gpslat decimal(18,15) default null,
  gpslong decimal(18,15) default null,
  gpszoom tinyint(3) unsigned default null,
  enabled tinyint(1) unsigned not null default '0')";

$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla countries creada correctamente</br>";
}
else{
  echo "Error al crear tabla countries</br>";
}


//crear tabla countrydetails
$sql="create table countrydetails(
  country_id tinyint(3) unsigned not null,
    language_id tinyint(3) unsigned not null,
    name varchar(45) COLLATE utf8_unicode_ci not null,
    description text COLLATE utf8_unicode_ci,
    enabled tinyint(1) unsigned not null default '0',
    PRIMARY KEY (country_id,language_id),
    KEY FK_country_id_idx (country_id),
    KEY language_id (language_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla countrydetails creada correctamente</br>";
}
else{
  echo "Error al crear tabla countrydetails</br>";
}


//crear tabla country_media
$sql="create table country_media(
country_id tinyint(3) unsigned not null,
media_id int(10) unsigned not null,
template_id int(10) unsigned not null,
position tinyint(3) unsigned not null default '0',
PRIMARY KEY (country_id,media_id,template_id),
KEY media_id (media_id))";

$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla country_media creada correctamente</br>";
}
else{
  echo "Error al crear tabla country_media</br>";
}
//crear tabla labels
$sql="create table labels(
id int(10) unsigned not null auto_increment,
name varchar(25) CHARACTER SET utf8 not null,
PRIMARY KEY (id),
UNIQUE KEY name (name)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla labels creada correctamente</br>";
}
else{
  echo "Error al crear tabla labels</br>";
}
//crear tabla labeldetails
$sql="create table labeldetails(
label_id int(10) unsigned NOT NULL,
language_id tinyint(3) unsigned NOT NULL,
description text COLLATE utf8_unicode_ci NOT NULL,
PRIMARY KEY (label_id,language_id),
KEY language_id (language_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla labeldetails creada correctamente</br>";
}
else{
  echo "Error al crear tabla labeldetails</br>";
}
//crear tabla languages
$sql="create table languages(
  id tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  short varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  icon varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  enabled tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY short (short)
)";

// se elimino orden de compra
$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla languages creada correctamente</br>";
}
else{
  echo "Error al crear tabla languages</br>";
}
//crear tabla loctions
$sql="create table locations(
  id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  country_id tinyint(3) unsigned NOT NULL,
  gpslat decimal(18,15) DEFAULT NULL,
  gpslong decimal(18,15) DEFAULT NULL,
  gpszoom tinyint(3) unsigned DEFAULT NULL,
  enabled tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  KEY country_id (country_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla locations creada correctamente</br>";
}
else{
  echo "Error al crear tabla locations</br>";
}

//crear tabla locationdetails
$sql="create table locationdetails(
  location_id smallint(5) unsigned NOT NULL,
  language_id tinyint(3) unsigned NOT NULL,
  name varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  description text COLLATE utf8_unicode_ci,
  enabled tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (location_id,language_id),
  KEY language_id (language_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla locationdetails creada correctamente</br>";
}
else{
  echo "Error al crear tabla locationdetails</br>";
}
//crear tabla location_media
$sql="create table location_media(
location_id smallint(5) unsigned NOT NULL,
 media_id int(10) unsigned NOT NULL,
 template_id int(10) unsigned NOT NULL,
 position tinyint(3) unsigned NOT NULL DEFAULT '0',
 PRIMARY KEY (location_id,media_id,template_id),
 KEY media_id (media_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla location_media creada correctamente</br>";
}
else{
  echo "Error al crear tabla location_media</br>";
}

//crear tabla occupations
$sql="create table occupations(
  id char(2) COLLATE utf8_unicode_ci NOT NULL,
    persons tinyint(3) unsigned NOT NULL,
    PRIMARY KEY (id)
)";

$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla occupations creada correctamente</br>";
}
else{
  echo "Error al crear tabla occupations</br>";
}


//crear tabla occupationdetails
$sql="create table occupationdetails(
  occupation_id char(2) COLLATE utf8_unicode_ci NOT NULL,
  language_id tinyint(3) unsigned NOT NULL,
  description varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (language_id,occupation_id),
  KEY occupation_id (occupation_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla occupationdetails creada correctamente</br>";
}
else{
  echo "Error al crear tabla occupationdetails</br>";
}
//crear tabla packages
$sql="create table packages(
  id smallint(5) unsigned NOT NULL,
    enabled tinyint(1) unsigned NOT NULL,
    PRIMARY KEY (id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla packages creada correctamente</br>";
}
else{
  echo "Error al crear tabla packages</br>";
}
//crear tabla packagedetails
$sql="create table packagedetails(
  package_id smallint(5) unsigned NOT NULL,
  language_id tinyint(3) unsigned NOT NULL,
  name varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  description text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (package_id,language_id),
  KEY package_id (package_id),
  KEY language_id (language_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla packagedetails creada correctamente</br>";
}
else{
  echo "Error al crear tabla packagedetails</br>";
}
//crear tabla packageroutes
$sql="create table packageroutes(
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  package_id smallint(5) unsigned NOT NULL,
  location_id smallint(5) unsigned NOT NULL,
  position tinyint(3) unsigned NOT NULL DEFAULT '0',
  minnights tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY package_id (package_id,location_id,position),
  KEY location_id (location_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla packageroutes creada correctamente</br>";
}
else{
  echo "Error al crear tabla packageroutes</br>";
}
//crear tabla packageroute_products
$sql="create table packageroute_products(
  packageroute_id int(10) unsigned NOT NULL,
    service_id smallint(5) unsigned NOT NULL,
    product_id int(10) unsigned NOT NULL,
    day tinyint(3) unsigned NOT NULL,
    PRIMARY KEY (packageroute_id,service_id,product_id),
    KEY packageroute_id (packageroute_id),
    KEY service_id (service_id),
    KEY product_id (product_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla packageroute_products creada correctamente</br>";
}
else{
  echo "Error al crear tabla packageroute_products</br>";
}
//crear tabla packageroute_services
$sql="create table packageroute_services(
  packageroute_id int(10) unsigned NOT NULL,
    service_id smallint(5) unsigned NOT NULL,
    quantity tinyint(3) unsigned NOT NULL,
    PRIMARY KEY (packageroute_id,service_id),
    KEY packageroute_id (packageroute_id),
    KEY service_id (service_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla packageroute_services creada correctamente</br>";
}
else{
  echo "Error al crear tabla packageroute_services</br>";
}
//crear tabla package_tags
$sql="create table package_tags(
  package_id smallint(5) unsigned NOT NULL,
  tag_id smallint(5) unsigned NOT NULL,
  PRIMARY KEY (package_id,tag_id),
  KEY package_id (package_id),
  KEY tag_id (tag_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla package_tags creada correctamente</br>";
}
else{
  echo "Error al crear tabla package_tags</br>";
}
//crear tabla package_transportoptions
$sql="create table package_transportoptions(
  id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  package_id smallint(5) unsigned NOT NULL,
  transporttype_id tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY package_id (package_id),
  KEY transporttype_id (transporttype_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla package_transportoptions creada correctamente</br>";
}
else{
  echo "Error al crear tabla package_transportoptions</br>";
}

//crear tabla paxoccupations
$sql="create table paxoccupations(
  id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
   pax tinyint(3) unsigned NOT NULL,
   occupation_id char(2) COLLATE utf8_unicode_ci NOT NULL,
   enabled tinyint(1) unsigned NOT NULL,
   PRIMARY KEY (id),
   UNIQUE KEY pax (pax,occupation_id),
   KEY occupation_id (occupation_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla paxoccupations creada correctamente</br>";
}
else{
  echo "Error al crear tabla paxoccupations</br>";
}

//crear tabla prices
$sql="create table prices(
  id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
   pax tinyint(3) unsigned NOT NULL,
   occupation_id char(2) COLLATE utf8_unicode_ci NOT NULL,
   enabled tinyint(1) unsigned NOT NULL,
   PRIMARY KEY (id),
   UNIQUE KEY pax (pax,occupation_id),
   KEY occupation_id (occupation_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla prices creada correctamente</br>";
}
else{
  echo "Error al crear tabla prices</br>";
}
//crear tabla products
$sql="create table products(
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  service_id smallint(5) unsigned NOT NULL,
  country_id tinyint(3) unsigned NOT NULL,
  location_id smallint(5) unsigned DEFAULT NULL,
  gpslat decimal(18,15) DEFAULT NULL,
  gpslong decimal(18,15) DEFAULT NULL,
  gpszoom tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (id),
  KEY service_id (service_id),
  KEY country_id (country_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla products creada correctamente</br>";
}
else{
  echo "Error al crear tabla products</br>";
}
//crear tabla productdetails
$sql="create table productdetails(
  product_id int(10) unsigned NOT NULL,
  language_id tinyint(3) unsigned NOT NULL,
  name varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  description text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (product_id,language_id),
  KEY language_id (language_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla productdetails creada correctamente</br>";
}
else{
  echo "Error al crear tabla productdetails</br>";
}

//crear tabla product_media
$sql="create table product_media(
  product_id int(10) unsigned NOT NULL,
 media_id int(10) unsigned NOT NULL,
 template_id int(10) unsigned NOT NULL,
 position tinyint(3) unsigned NOT NULL DEFAULT '0',
 PRIMARY KEY (product_id,media_id,template_id),
 KEY media_id (media_id)
)";


$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla product_media creada correctamente</br>";
}
else{
  echo "Error al crear tabla product_media</br>";
}

//crear tabla seasons
$sql="create table seasons(
  id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id)
)";
$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla seasons creada correctamente</br>";
}
else{
  echo "Error al crear tabla seasons</br>";
}
//crear tabla seasonperiods
$sql="create table seasonperiods(
  id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  season_id smallint(5) unsigned NOT NULL,
  startdate date NOT NULL,
  enddate date NOT NULL,
  PRIMARY KEY (id),
  KEY season_id (season_id)
)";
$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla seasonperiods creada correctamente</br>";
}
else{
  echo "Error al crear tabla seasonperiods</br>";
}
//crear tabla servicedetails
$sql="create table servicedetails(
  service_id smallint(5) unsigned NOT NULL,
  language_id tinyint(3) unsigned NOT NULL,
  name varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (service_id,language_id),
  KEY language_id (language_id)
)";
$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla servicedetails creada correctamente</br>";
}
else{
  echo "Error al crear tabla servicedetails</br>";
}

//crear tabla services
$sql="create table services(
  id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  bylocation tinyint(1) NOT NULL DEFAULT '0',
  byitinerary tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
)";
$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla services creada correctamente</br>";
}
else{
  echo "Error al crear tabla services</br>";
}
//crear tabla tagdetails
$sql="create table tagdetails(
  tag_id smallint(5) unsigned NOT NULL,
  language_id tinyint(3) unsigned NOT NULL,
  name varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (tag_id,language_id),
  KEY tag_id (tag_id),
  KEY language_id (language_id)
)";
$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla tagdetails creada correctamente</br>";
}
else{
  echo "Error al crear tabla tagdetails</br>";
}

//crear tabla tags
$sql="create table tags(
  id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  enabled tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (id)
)";
$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla tags creada correctamente</br>";
}
else{
  echo "Error al crear tabla tags</br>";
}

//crear tabla transporttypedetail
$sql="create table transporttypedetail(
  transporttype_id tinyint(3) unsigned NOT NULL,
  language_id tinyint(3) unsigned NOT NULL,
  name varchar(45) COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (transporttype_id,language_id),
    KEY language_id (language_id)
)";
$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla transporttypedetail creada correctamente</br>";
}
else{
  echo "Error al crear tabla transporttypedetail</br>";
}
//crear tabla transporttypes
$sql="create table transporttypes(
  id tinyint(3) unsigned not null PRIMARY KEY auto_increment,
  defaults tinyint(1) unsigned not null,
  enabled tinyint(1) unsigned not null
)";
$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla transporttypes creada correctamente</br>";
}
else{
  echo "Error al crear tabla transporttypes</br>";
}
//crear tabla itineraries
$sql="create table itineraries(
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  package_id smallint(5) unsigned NOT NULL,
  package_transportoption_id smallint(5) unsigned NOT NULL,
  startdate date NOT NULL,
  totalpax tinyint(3) unsigned NOT NULL,
  uuid binary(16) NOT NULL,
  PRIMARY KEY (id),
  KEY package_id (package_id),
  KEY package_transportoption_id (package_transportoption_id)
)";
$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla itineraries creada correctamente</br>";
}
else{
  echo "Error al crear tabla itineraries</br>";
}

//crear tabla itineraryprices
$sql="create table itineraryprices(
  service_id smallint(5) unsigned NOT NULL,
  itinerary_paxoccupation_id int(50) unsigned NOT NULL,
  price decimal(12,4) NOT NULL,
  PRIMARY KEY (service_id,itinerary_paxoccupation_id),
  KEY service_id (service_id),
  KEY itinerary_paxoccupation_id (itinerary_paxoccupation_id)
)";
$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla itineraryprices creada correctamente</br>";
}
else{
  echo "Error al crear tabla itineraryprices</br>";
}

//crear tabla itineraryroutes
$sql="create table itineraryroutes(
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  itinerary_id int(10) unsigned NOT NULL,
  location_id smallint(5) unsigned NOT NULL,
  position tinyint(3) unsigned NOT NULL DEFAULT '0',
  minnights tinyint(3) unsigned NOT NULL,
  nights tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (id),
  KEY itinerary_id (itinerary_id),
  KEY location_id (location_id)
)";
$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla itineraryroutes creada correctamente</br>";
}
else{
  echo "Error al crear tabla itineraryroutes</br>";
}
//crear tabla itineraryroute_products
$sql="create table itineraryroute_products(
  itineraryroute_id int(10) unsigned NOT NULL,
  service_id smallint(5) unsigned NOT NULL,
  product_id int(10) unsigned NOT NULL,
  day tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (itineraryroute_id,service_id,product_id),
  KEY itineraryroute_id (itineraryroute_id),
  KEY service_id (service_id),
  KEY product_id (product_id)
)";
$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla itineraryroute_products creada correctamente</br>";
}
else{
  echo "Error al crear tabla itineraryroute_products</br>";
}
//crear tabla itineraryroute_services
$sql="create table itineraryroute_services(
  itineraryroute_id int(10) unsigned NOT NULL,
    service_id smallint(5) unsigned NOT NULL,
    minquantity tinyint(3) unsigned NOT NULL,
    quantity tinyint(3) unsigned NOT NULL,
    PRIMARY KEY (itineraryroute_id,service_id),
    KEY itineraryroute_id (itineraryroute_id),
    KEY service_id (service_id)
)";
$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla itineraryroute_services creada correctamente</br>";
}
else{
  echo "Error al crear tabla itineraryroute_services</br>";
}

//crear tabla itinerary_paxoccupations
$sql="create table itinerary_paxoccupations(
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  itinerary_id int(10) unsigned NOT NULL,
  paxoccupation_id smallint(5) unsigned NOT NULL,
  PRIMARY KEY (id),
  KEY itinerary_id (itinerary_id),
  KEY paxoccupation_id (paxoccupation_id)
)";
$resultado = mysqli_query($conexion, $sql);
if($resultado){
  echo "Tabla itinerary_paxoccupations creada correctamente</br>";
}
else{
  echo "Error al crear tabla itinerary_paxoccupations</br>";
}
echo "</br><strong>Constraints</strong></br>";



echo "</br>Instalacion de la base de datos Finalizada";
 ?>
