<?php 
session_start();
require_once "../../clases/Conexion.php";
$c= new conectar();
$conexion=$c->conexion();
?>
<div class="row">
	<div class="col-sm-4">
		<form id="frmVentasProductos">

		<hr>
			<div>
			<label>Seleciona Cliente</label>
			<select class="form-control input-sm" id="clienteVenta" name="clienteVenta">
				<option value="A">Selecciona</option>
				<option value="0">Sin cliente</option>
				<?php
				$sql="SELECT cedula,nombre,telefono
				from cliente";
				$result=mysqli_query($conexion,$sql);
				while ($cliente=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $cliente[0] ?>"><?php echo $cliente[0]." ".$cliente[1] ?></option>
				<?php endwhile; ?>
			</select>
			</div>		

			<div>
			<label>Producto</label>
			<select class="form-control input-sm" id="productoVenta" name="productoVenta">
				<option value="A">Selecciona</option>
				<?php
				$sql="SELECT idProducto,
				descripcion
				from producto";
				$result=mysqli_query($conexion,$sql);

				while ($producto=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $producto[0] ?>"><?php echo $producto[1] ?></option>
				<?php endwhile; ?>
			</select>
			</div>
			<label>Precio Unitario</label>
			<input  readonly type="text" class="form-control input-sm" id="preciounitV" name="preciounitV">
	
			<label>Selecciona Descuento:</label>
						<select  class="form-control input-sm" id="descuentoV" name="descuentoV">
							<option  name="0.2">0.2</option>
							<option   name="0.3">0.3</option>
							<option   name="0.5">0.5</option>
							<option   name="0.10">0.10</option>
						</select>
		
			<label>Cantidad</label>
			<input  type="text" class="form-control input-sm" id="cantidadV" name="cantidadV">
			<p></p>
			<span class="btn btn-primary" id="btnAgregaVenta">Agregar</span>
			<span class="btn btn-danger" id="btnVaciarVentas">Vaciar ventas</span>
		</form>
	</div>
	<div class="col-sm-3">
		
	</div>
	<div class="col-sm-4">
		<div id="tablaVentasTempLoad"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$('#tablaVentasTempLoad').load("detalles/tablaDetalleTemp.php");

		$('#productoVenta').change(function(){
			$.ajax({
				type:"POST",
				data:"idproducto=" + $('#productoVenta').val(),
				url:"../procesos/detalles/llenarFormProducto.php",
				success:function(r){
					dato=jQuery.parseJSON(r);

					$('#preciounitV').val(dato['precioVenta']);
					

				}
			});
		});

		$('#btnAgregaVenta').click(function(){
			vacios=validarFormVacio('frmVentasProductos');

			if(vacios > 0){
				alertify.alert("Debes llenar todos los campos!!");
				return false;
			}

			datos=$('#frmVentasProductos').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/detalles/agregaProductoTemp.php",
				success:function(r){
					alert(datos);
					$('#tablaVentasTempLoad').load("detalles/tablaDetalleTemp.php");
				}
			});
		});

		$('#btnVaciarVentas').click(function(){

		$.ajax({
			url:"../procesos/detalles/vaciarTemp.php",
			success:function(r){
				$('#tablaVentasTempLoad').load("detalles/tablaDetalleTemp.php");
			}
		});
	});

	});
</script>

<script type="text/javascript">
	function quitarP(index){
		$.ajax({
			type:"POST",
			data:"ind=" + index,
			url:"../procesos/detalles/quitarproducto.php",
			success:function(r){
				$('#tablaVentasTempLoad').load("detalles/tablaDetalleTemp.php");
				alertify.success("Se quito el producto :D");
			}
		});
	}

	function crearVenta(){
		$.ajax({
			url:"../procesos/detalles/crearDetalle.php",
			success:function(r){
				alert(r);
				if(r == 1){
					$('#tablaVentasTempLoad').load("detalles/tablaDetalleTemp.php");
					$('#frmVentasProductos')[0].reset();
					alertify.alert("Venta creada con exito, consulte la informacion de esta en ventas hechas :D");
				}else {
					
					alertify.alert("No se pudo crear la venta!");
				}
			}
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#clienteVenta').select2();
		$('#productoVenta').select2();

	});
</script>

