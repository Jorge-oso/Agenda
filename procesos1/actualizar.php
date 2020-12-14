<?php 
	require_once "../clases/conexion.php";
	require_once "../clases/crudc.php";

	$obj= new crud();

	$datos=array(
		$_POST['idagendaU'],
		$_POST['nombreU'],
		$_POST['apellidopU'],
		$_POST['apellidomU'],
		$_POST['telefonoU'],
		$_POST['emailU'],
		$_POST['id_categoriaU']
				);

	echo $obj->actualizar1($datos);
 ?>