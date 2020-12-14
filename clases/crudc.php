<?php 

class crud{
	public function agregar($datos){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT into t_categoria(nombreC,descripcionC)
		values ('$datos[0]',
		'$datos[1]')";
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($idcategoria){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_categoria,
		nombreC,
		descripcionC
		from t_categoria 
		where id_categoria='$idcategoria'";
		$result=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($result);

		$datos=array(
			'id_categoria' => $ver[0],
			'nombreC' => $ver[1],
			'descripcionC' => $ver[2]
		);
		return $datos;
	}


	public function actualizar($datos){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE t_categoria set nombreC='$datos[0]',
		descripcionC='$datos[1]'
		where id_categoria='$datos[2]'";

		return mysqli_query($conexion,$sql);
	}
	public function eliminar($idcategoria){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE from t_categoria where id_categoria='$idcategoria'";
		return mysqli_query($conexion,$sql);
	}

	public function agregar1($datos){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT into t_agenda(nombreT,paternoT,maternoT,telefonoT,emailT,
		id_categoria)
		values ('$datos[0]',
		'$datos[1]',
		'$datos[2]',
		'$datos[3]',
		'$datos[4]',
		'$datos[5]')";

		$Respuesta = mysqli_query($conexion,$sql);
		$Mensaje = "";
		if(!$Respuesta){
			$Mensaje = mysqli_error($conexion);
		}
		else{
			$Mensaje = "1";
		}
		return $Mensaje;
	}
	public function obtenDatos1($idagenda){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_agenda,
		nombreT,
		paternoT,
		maternoT,
		telefonoT,
		emailT,
		id_categoria
		from t_agenda
		where id_agenda='$idagenda'";
		$result=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($result);

		$datos=array(
			'id_agenda' => $ver[0],
			'nombreT' => $ver[1],
			'paternoT' => $ver[2],
			'maternoT'=>$ver[3],
			'telefonoT'=>$ver[4],
			'emailT'=>$ver[5],
			'id_categoria'=>$ver[6]
		);
		return $datos;
	}
	public function actualizar1($datos){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE t_agenda set nombreT='$datos[1]',
		paternoT='$datos[2]',
		maternoT='$datos[3]',
		telefonoT='$datos[4]',
		emailT='$datos[5]',
		id_categoria='$datos[6]'
		where id_agenda='$datos[0]'";

		$Respuesta = mysqli_query($conexion,$sql);
		$Mensaje = "";
		if(!$Respuesta){
			$Mensaje = mysqli_error($conexion);
		}
		else{
			$Mensaje = "1";
		}
		return $Mensaje;
	}
	public function eliminar1($idagenda){
		$obj= new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE from t_agenda where id_agenda='$idagenda'";
		return mysqli_query($conexion,$sql);
	}
}

?>