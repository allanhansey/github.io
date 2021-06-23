
<?php 
	require_once "../../clases/Conexion.php";

	$obj= new conectar();
	$conexion= $obj->conexion();

	$sql="SELECT cedula, 
				nombre,
				telefono,
				direccion,
				correo
		FROM cliente";

		$stmt=$conexion->prepare($sql);
		$stmt->execute();
		$result=$stmt->get_result();
 ?>

<div class="table-responsive">
	 <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	 	<caption><label>Clientes</label></caption>
	 	<tr>
	 		<td>Cedula</td>
	 		<td>Nombre</td>
	 		<td>Telefono</td>
	 		<td>Direccion</td>
	 		<td>Correo</td>
	 		<td>Editar</td>
	 		<td>Eliminar</td>
	 	</tr>

	 	<?php while($ver=mysqli_fetch_row($result)): ?>

	 	<tr>
			<td><?php echo $ver[0]; ?></td>
	 		<td><?php echo $ver[1]; ?></td>
	 		<td><?php echo $ver[2]; ?></td>
	 		<td><?php echo $ver[3]; ?></td>
	 		<td><?php echo $ver[4]; ?></td>
	 		<td>
				<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalClientesUpdate" onclick="agregarDatosCliente('<?php echo $ver[0]; ?>')">
					<span class="glyphicon glyphicon-pencil"></span>
				</span>
			</td>
			<td>
				<span class="btn btn-danger btn-xs" onclick="eliminarCliente('<?php echo $ver[0]; ?>')">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
			</td>
	 	</tr>
	 <?php endwhile; ?>
	 </table>
</div>