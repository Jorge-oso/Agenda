<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudc.php";
	$obj= new crud();

	$datos=array(
		$_POST['nombre'],
		$_POST['descripcion']
				);

	echo $obj->agregar($datos);
?>