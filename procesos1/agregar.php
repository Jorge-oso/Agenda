<?php
require_once "../clases/conexion.php";
require_once "../clases/crudc.php";
$obj= new crud();

$datos=array(
	$_POST['nombre'],
	$_POST['apellidop'],
	$_POST['apellidom'],
	$_POST['telefono'],
	$_POST['email'],
    $_POST['id_categoria']
);

echo $obj->agregar1($datos);
?>