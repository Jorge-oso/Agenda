<?php 
	
	require_once "../clases/conexion.php";
	require_once "../clases/crudc.php";

	$obj= new crud();

	echo json_encode($obj->obtenDatos($_POST['idcategoria']));

 ?>