<?php 
	
	require_once "../clases/conexion.php";
	require_once "../clases/crudc.php";

	$obj= new crud();

	echo $obj->eliminar($_POST['idcategoria']);

 ?>