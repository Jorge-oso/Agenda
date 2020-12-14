<?php 
include("../clases/conexion.php");
$sql="SELECT * FROM t_categoria";
$obj= new conectar();
$conexion=$obj->conexion();
$result = mysqli_query($conexion,$sql);
while ($data=mysqli_fetch_array($result)) {
	$json[] = array(
		'id_categoria'=>$data['id_categoria'],
		'categoria'=>$data['nombreC']);
}
echo json_encode($json);
?>