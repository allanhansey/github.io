<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Detalles.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$obj= new detalles();

	$sql="SELECT numeroFactura,
				empleado_id,
				cliente,fecha,total
			from factura group by numeroFactura";
	$result=mysqli_query($conexion,$sql); 
	?>

<h4>Reportes y ventas</h4>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
				<caption><label>Ventas :)</label></caption>
				<tr>
					<td>#N de facturas</td>
					<td>Empleado Id</td>
					<td>Cliente</td>
					<td>Fecha</td>
					<td>Total</td>
					<td>Acciones</td>
					
				</tr>
		<?php while($ver=mysqli_fetch_row($result)): ?>
				<tr>
					<td><?php echo $ver[0] ?></td>
					<td><?php echo $ver[1] ?></td>
					<td>
						<?php
							if($obj->nombreCliente($ver[2])==" "){
								echo "S/C";
							}else{
								echo $obj->nombreCliente($ver[2]);
							}
						 ?>
					</td>
					<td><?php echo $ver[3] ?></td>
					<td>
						<?php 
							echo "$".$obj->obtenerTotal($ver[0]);
						 ?>
					</td>
					<td>
						<span class="btn btn-danger btn-xs" onclick="eliminarFactura('<?php echo $ver[0]; ?>')">
							<span class="glyphicon glyphicon-remove"></span>
						</span>
					</td>
				</tr>
		<?php endwhile; ?>
			</table>
		</div>
	</div>
	<div class="col-sm-1"></div>
</div>