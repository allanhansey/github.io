<?php 
	
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();

	$sql="SELECT 	id,
					producto_id,
					pantalla,
					almacenamiento,
					procesador,
					bateria,
					camara
			from especificaciones";
	$result=mysqli_query($conexion,$sql);

 ?>

<div class="table-responsive">
<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Empleados</label></caption>
	<tr>
		<td>#Id</td>
		<td>#Producto</td>
		<td>Pantalla</td>
		<td>Almacenamiento</td>
		<td>Procesador</td>
		<td>Bateria</td>
		<td>Camara</td>
	
	</tr>

	<?php while($ver=mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $ver[0]; ?></td>
		<td><?php echo $ver[1]; ?></td>
		<td><?php echo $ver[2]; ?></td>
		<td><?php echo $ver[3]; ?></td>
		<td><?php echo $ver[4]; ?></td>
		<td><?php echo $ver[5]; ?></td>
		<td><?php echo $ver[6]; ?></td>

	</tr>
<?php endwhile; ?>
</table>
	</div>

