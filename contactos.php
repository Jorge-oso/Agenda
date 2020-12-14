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
						Contactos 
					</div>
					<div class="card-body bg-secondary">
						<span class="btn btn-primary" data-toggle="modal" data-target="#agregarnuevosdatosmodal">
							Agregar <span class="fa fa-plus-square"></span>
						</span>
						<hr>
						<div id="tablaDatatable"></div>
					</div>
					<div class="card-header bg-light">
						By Tripiante	
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Agregar-->
	<div class="modal fade" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Agregar contacto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevo">
						<select class="form-control input-sm" data-live-search="true" id="categoria" name="id_categoria">
							<option value="0" selected="true" disabled>Selecciona una Categoria</option>
						</select>
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre">
						<label>Apellido paterno</label>
						<input type="text" class="form-control input-sm" id="apellidop" name="apellidop">
						<label>Apellido Materno</label>
						<input type="text" class="form-control input-sm" id="apellidom" name="apellidom">
						<label>Telefono</label>
						<input type="text" class="form-control input-sm" id="telefono" name="telefono">
						<label>Email</label>
						<input type="text" class="form-control input-sm" id="email" name="email">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" id="btnAgregarnuevo" class="btn btn-primary">Guardar Cambios</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Modificar-->
	<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar contactos</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevoU">
						<input type="text" hidden="" id="idagendaU" name="idagendaU">
						<select class="form-control input-sm" data-live-search="true" id="categoriaU" name="id_categoriaU">
							<option value="0" selected="true" disabled>Selecciona una Categoria</option>
						</select>
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
						<label>Apellido paterno</label>
						<input type="text" class="form-control input-sm" id="apellidopU" name="apellidopU">
						<label>Apellido Materno</label>
						<input type="text" class="form-control input-sm" id="apellidomU" name="apellidomU">
						<label>Telefono</label>
						<input type="text" class="form-control input-sm" id="telefonoU" name="telefonoU">
						<label>Email</label>
						<input type="text" class="form-control input-sm" id="emailU" name="emailU">
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
					url:"procesos1/agregar.php",
					success:function(r){
						console.log(r);
						if(r==1){
							$('#frmnuevo')[0].reset();
							$('#tablaDatatable').load('tabla1.php');
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
				url:"procesos1/actualizar.php",
				success:function(r){
					console.log(r);
					if(r==1){
						$('#tablaDatatable').load('tabla1.php');
						alertify.success("Actualizado con exito :D");
					}else{
						alertify.error("Fallo al actualizar :(");
					}
				}
			});
		});
	});
	
	$(function(){
		$.ajax({
          url: 'procesos1/categoria.php', //Url indica el back-end a conectar
           type: 'POST',//GET/POST
           data:{},
           success:function(respuesta){
               //console.log(respuesta);
               let datos = JSON.parse(respuesta);
               //$('#TuID').children('option:not(:first)').remove(); /*Borra todos los items a excepcion del primero*/
               datos.forEach(item =>{
               	$('#categoria').append($('<option />', {
               		text: item.categoria,
               		value: item.id_categoria,
               	}));
               	$('#categoriaU').append($('<option />', {
               		text: item.categoria,
               		value: item.id_categoria,
               	}));
               });
           }
       });
	});
	
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tablaDatatable').load('tabla1.php');
	});
</script>

<script>
	function agregaFrmActualizar(idagenda){
		$.ajax({
			type:"POST",
			data:"idagenda=" + idagenda,
			url:"procesos1/obtenDatos.php",
			success:function(r){
				console.log(r);
				datos=jQuery.parseJSON(r);
				$('#idagendaU').val(datos['id_agenda']);
				$('#nombreU').val(datos['nombreT']);
				$('#apellidopU').val(datos['paternoT']);
				$('#apellidomU').val(datos['maternoT']);
				$('#telefonoU').val(datos['telefonoT']);
				$('#emailU').val(datos['emailT']);
				$('#categoriaU').val(datos['id_categoria']);
			}
		});
	}
	function eliminarDatos(idagenda){
		alertify.confirm('Eliminar una contacto', '¿Seguro de eliminar este contacto tripiante :(?', function(){ 

			$.ajax({
				type:"POST",
				data:"idagenda=" + idagenda,
				url:"procesos1/eliminar.php",
				success:function(r){
					if(r==1){
						$('#tablaDatatable').load('tabla1.php');
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