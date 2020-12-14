<?php 
require_once "header.php";
require_once "menu.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require_once "scripts.php";  ?>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="jumbotron bg-success">
					<div class="card-header bg-light">
						Categoria
					</div>
					<div class="card-body bg-secondary">
						<span class="btn btn-primary" data-toggle="modal" data-target="#agregarnuevosdatosmodal">
							Agregar <span class="fa fa-plus-square"></span>
						</span>
						<hr>
						<div id="tablaDatatable"></div>
					</div>
					<div class="card-footer text-muted bg-light">
						By Tripiante
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Agrega</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevo">
						<label>Nombre categoria</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre" required>
						<label>Descripcion</label>
						<input type="text" class="form-control input-sm" id="descripcion" name="descripcion" required>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" id="btnAgregarnuevo" class="btn btn-primary">Guardar Cambios</button>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal -->
	<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar categoria</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevoU">
						<input type="text" hidden="" id="idcategoriaU" name="idcategoriaU">
						<label>Nombre categoria</label>
						<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
						<label>Descripcion</label>
						<input type="text" class="form-control input-sm" id="descripcionU" name="descripcionU">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-warning" id="btnActualizar">Actualizar</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#btnAgregarnuevo').click(function(){
			if($('#nombre').val()!=""){
				datos=$('#frmnuevo').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"procesos/agregar.php",
					success:function(r){
						if(r==1){
							$('#frmnuevo')[0].reset();
							$('#tablaDatatable').load('tabla.php');
							alertify.success("agregado con exito :D");
						}else{
							alertify.error("Fallo al agregar :(");
						}
					}
				});
			}else{
				alertify.error('Error campos vacios');
			}
			return false;
		});

		$('#btnActualizar').click(function(){
			datos=$('#frmnuevoU').serialize();

			$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/actualizar.php",
				success:function(r){
					if(r==1){
						$('#tablaDatatable').load('tabla.php');
						alertify.success("Actualizado con exito :D");
					}else{
						alertify.error("Fallo al actualizar :(");
					}
				}
			});
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tablaDatatable').load('tabla.php');
	});
</script>

<script type="text/javascript">
	function agregaFrmActualizar(idcategoria){
		$.ajax({
			type:"POST",
			data:"idcategoria=" + idcategoria,
			url:"procesos/obtenDatos.php",
			success:function(r){
				datos=jQuery.parseJSON(r);
				$('#idcategoriaU').val(datos['id_categoria']);
				$('#nombreU').val(datos['nombreC']);
				$('#descripcionU').val(datos['descripcionC']);
			}
		});
	}

	function eliminarDatos(idcategoria){
		alertify.confirm('Eliminar una categoria', '¿Seguro de eliminar esta categoria tripiante :(?', function(){ 

			$.ajax({
				type:"POST",
				data:"idcategoria=" + idcategoria,
				url:"procesos/eliminar.php",
				success:function(r){
					if(r==1){
						$('#tablaDatatable').load('tabla.php');
						alertify.success("Eliminado con exito !");
					}else{
						alertify.error("No se pudo eliminar...");
					}
				}
			});

		}
		, function(){

		});
	}
</script>