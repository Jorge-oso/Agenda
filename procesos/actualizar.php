<?php 
	require_once "../clases/conexion.php";
	require_once "../clases/crudc.php";

	$obj= new crud();

	$datos=array(
		$_POST['nombreU'],
		$_POST['descripcionU'],
		$_POST['idcategoriaU']
				);

	echo $obj->actualizar($datos);
 ?>