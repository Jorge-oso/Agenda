<?php 
	
	require_once "../clases/conexion.php";
	require_once "../clases/crudc.php";

	$obj= new crud();

	echo $obj->eliminar1($_POST['idagenda']);

 ?>