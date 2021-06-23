<?php 
	
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();

	$sql="SELECT idEmpleado,
					cedula,
					nombre,
					direccion,
					telefono,
					correo
			from empleado";
	
	$stmt=$conexion->prepare($sql);
	$stmt->execute();
	$result=$stmt->get_result();

 ?>

<div class="table-responsive">
<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Empleados</label></caption>
	<tr>
		<td>#Id</td>
		<td>#Cedula</td>
		<td>Nombre</td>
		<td>Direccion</td>
		<td>Telefono</td>
	
	</tr>

	<?php while($ver=$result->fetch_row()): ?>

	<tr>
		<td><?php echo $ver[0]; ?></td>
		<td><?php echo $ver[1]; ?></td>
		<td><?php echo $ver[2]; ?></td>
		<td><?php echo $ver[3]; ?></td>
		<td><?php echo $ver[4]; ?></td>
		<td><?php echo $ver[5]; ?></td>

	</tr>
<?php endwhile; ?>
</table>
	</div>