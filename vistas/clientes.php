<?php 
session_start();
if(isset($_SESSION['cedula'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>clientes</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Clientes</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmClientes">
					    <label>Cedula</label>
						<input type="text" class="form-control input-sm" id="cedula" name="cedula">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre">
						<label>Telefono</label>
						<input type="text" class="form-control input-sm" id="telefono" name="telefono">
						<label>Direccion</label>
						<input type="text" class="form-control input-sm" id="direccion" name="direccion">
						<label>Correo</label>
						<input type="text" class="form-control input-sm" id="correo" name="correo">
						
						<p></p>
						<span class="btn btn-primary" id="btnAgregarCliente">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaClientesLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalClientesUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizar cliente</h4>
					</div>
					<div class="modal-body">
						<form id="frmClientesU">
						<input type="hidden" type="text" class="form-control input-sm" id="cedulaU" name="cedulaU">   
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" id="nombreU" name="nombreU" >
							<label>Telefono</label>
							<input type="text" class="form-control input-sm" id="telefonoU" name="telefonoU" >
							<label>Direccion</label>
							<input type="text" class="form-control input-sm" id="direccionU" name="direccionU" >
							<label>Correo</label>
							<input type="text" class="form-control input-sm" id="correoU" name="correoU" >
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaCliente" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">


		function agregarDatosCliente(idCliente){

			$.ajax({
				type:"POST",
				data:"idcliente=" + idCliente,
				url:"../procesos/clientes/obtenDatosCliente.php",
				success:function(r){
					
					dato=jQuery.parseJSON(r);
					$('#cedulaU').val(dato['cedula']);
					$('#nombreU').val(dato['nombre']);
					$('#telefonoU').val(dato['telefono']);
					$('#direccionU').val(dato['direccion']);
					$('#correoU').val(dato['correo']);

				}
			});
		}

		function eliminarCliente(idCliente){
			alertify.confirm('¿Desea eliminar este cliente?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcliente=" + idCliente,
					url:"../procesos/clientes/eliminarCliente.php",
					success:function(r){
						alert(idCliente);
						
						if(r==1){
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Eliminado con exito!!");
						}else{
							alertify.error("No se pudo eliminar :(");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelo !')
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaClientesLoad').load("clientes/tablaClientes.php");

			$('#btnAgregarCliente').click(function(){

				vacios=validarFormVacio('frmClientes');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmClientes').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/clientes/agregaCliente.php",
					success:function(r){

						if(r==1){
							$('#frmClientes')[0].reset();
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Cliente agregado con exito!");
						}else{
							alertify.error("Error: No se pudo agregar cliente");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaCliente').click(function(){
				datos=$('#frmClientesU').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/clientes/actualizaCliente.php",
					success:function(r){
						alert(datos);
						if(r==1){
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Cliente actualizado con exito!");
						}else{
							alertify.error("Error: No se pudo actualizar cliente");
						}
					}
				});
			})
		})
	</script>





	<?php 
}else{
	header("location:../index.php");
}
?>