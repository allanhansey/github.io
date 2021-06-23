<?php 
session_start();
if(isset($_SESSION['cedula'])){

	?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>Productos</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Productos</h1>
			<div class="row">
				<div class="col-sm-4">
				<div >

					<form id="frmArticulos" enctype="multipart/form-data">

						<label>#Id</label>
						<input type="text" class="form-control input-sm" id="id" name="id">
						<label>Descripcion</label>
						<input type="text" class="form-control input-sm" id="descripcion" name="descripcion">
						<label>Numero de serie</label>
						<input type="text" class="form-control input-sm" id="numeroSerie" name="numeroSerie">
						<label>Precio Compra</label>
						<input type="text" class="form-control input-sm" id="precioCompra" name="precioCompra">
						<label>Precio Venta</label>
						<input type="text" class="form-control input-sm" id="precioVenta" name="precioVenta">
						<label>Selecciona Tipo:</label>
						<select onchange="mostrarEspecificaciones();" class="form-control input-sm" id="tipo" name="tipo">
							<option  value="Accesorio" name="accesorio">Accesorio</option>
							<option  value="Celular" name="celular">Celular</option>
						</select>
						

					</form>
					
					<div id="Celulares" style="display:none">
					<form  id="formEspecificaciones" enctype="multipart/form-data">
						<label>Pantalla</label> 
						<input type="text" class="form-control input-sm" id="pantalla" name="pantalla">
						<label>Almacenamiento</label>
						<input type="text" class="form-control input-sm" id="almacenamiento" name="almacenamiento">
						<label>Procesador</label>
						<input type="text" class="form-control input-sm" id="procesador" name="procesador">
						<label>Bateria</label>
						<input type="text" class="form-control input-sm" id="bateria" name="bateria">
						<label>Camara</label>
						<input type="text" class="form-control input-sm" id="camara" name="camara">
                       </form>
					   </div> 
					</div>

					   <p></p>
					<span id="btnAgregaArticulo" class="btn btn-primary">Agregar</span>
				</div>
				<div class="col-sm-8">
					<div id="tablaArticulosLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->
		
		<!-- Modal -->
		<div class="modal fade" id="abremodalUpdateArticulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza Articulo</h4>
					</div>
					<div class="modal-body">
						<form id="frmArticulosU" enctype="multipart/form-data">
						<input type="hidden" type="text" class="form-control input-sm" id="idArticulo" name="idArticulo">
						<label>Descripcion</label>
						<input type="text" class="form-control input-sm" id="descripcionU" name="descripcionU">
						<label>Numero de serie</label>
						<input type="text" class="form-control input-sm" id="numeroSerieU" name="numeroSerieU">
						<label>Precio Compra</label>
						<input type="text" class="form-control input-sm" id="precioCompraU" name="precioCompraU">
						<label>Precio Venta</label>
						<input type="text" class="form-control input-sm" id="precioVentaU" name="precioVentaU">
						<p></p>	
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaArticulo" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function agregaDatosArticulo(idarticulo){
			$.ajax({
				type:"POST",
				data:"idart=" + idarticulo,
				url:"../procesos/articulos/obtenDatosArticulo.php",
				success:function(r){
					
					dato=jQuery.parseJSON(r);
					$('#idArticulo').val(dato['idProducto']);
					$('#descripcionU').val(dato['descripcion']);
					$('#numeroSerieU').val(dato['numero_serie']);
					$('#precioCompraU').val(dato['precioCompra']);
					$('#precioVentaU').val(dato['precioVenta']);

				}
			});
		}

		function eliminaArticulo(idArticulo){
			alertify.confirm('¿Desea eliminar este producto?', function(){ 
				$.ajax({
					type:"POST",
					data:"idarticulo=" + idArticulo,
					url:"../procesos/articulos/eliminarArticulo.php",
					success:function(r){
					
					if(r==1){
						$('#tablaArticulosLoad').load("articulos/tablaProductos.php");
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

		function mostrarEspecificaciones(){
			var x = document.getElementById("tipo");
			var opt = x.options[x.selectedIndex].value;
			var y = document.getElementById("Celulares");
			if(opt == 'Celular'){
				y.style.display = "block";		
			}
			if(opt =='Accesorio'){
				y.style.display = "none";
			}
	}

	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaArticulo').click(function(){
				datos=$('#frmArticulosU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/articulos/actualizaArticulos.php",
					success:function(r){
						if(r==1){
							$('#tablaArticulosLoad').load("articulos/tablaProductos.php");
							alertify.success("Actualizado con exito :D");
						}else{
							alertify.error("Error al actualizar :(");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
	idProducto=0;
		$(document).ready(function(){
			$('#tablaArticulosLoad').load("articulos/tablaProductos.php");

			$('#btnAgregaArticulo').click(function(){

				vacios=validarFormVacio('frmArticulos');
				
				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}
				
				//ARTICULOS
				datos=$('#frmArticulos').serialize();
				
				idProducto=$('input[name=id]').val();
				console.log(idProducto);
				$.ajax({
					url: "../procesos/articulos/insertaArticulos.php",
					type: "POST",
					data: datos,
					
					success:function(r){
						alert(r);
						if(r == 1){
							$('#frmArticulos')[0].reset();
							$('#tablaArticulosLoad').load("articulos/tablaProductos.php");
							alertify.success("Agregado con exito :D");
						}else{
							alert(datos);
							alertify.error("Error al subir el archivo");
						}
					}
				});

				//ESPECIFICACIONES 
				
				datos=$('#formEspecificaciones').serialize()+ '&NonFormValue='+idProducto; 
				
				$.ajax({
					url: "../procesos/especificaciones/insertaEspecificaciones.php",
					type: "POST",
					data: datos,
					
					success:function(r){
						alert(r);
						if(r == 1){
							$('#formEspecificaciones')[0].reset();
							$('#tablaEspecificacionesLoad').load("especificaciones/tablaEspecificaciones.php");
							alertify.success("Especificacion agregada con exito :D");
						}else{
							alert(datos);
							alertify.error("Error al agregar especificaiones");
						}
					}

				});
				
			});
		});
	</script>

	<?php 
}else{
	header("location:../index.php");
}
?>