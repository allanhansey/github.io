
<?php 
	require_once "../../clases/Conexion.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$sql="SELECT idProducto,
					descripcion,
					numero_serie,
					precioCompra,
					tipo,
					precioVenta
		  FROM producto";

		$stmt=$conexion->prepare($sql);
		$stmt->execute();
		$result=$stmt->get_result();

 ?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Productos</label></caption>
	<tr>
		<td>#Id</td>
		<td>Descripcion</td>
		<td>#Numero Serie</td>
		<td>Precio Compra</td>
		<td>Tipo</td>
		<td>Precio Venta</td>
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
		<td><?php echo $ver[5]; ?></td>
		<td>
			<span  data-toggle="modal" data-target="#abremodalUpdateArticulo" class="btn btn-warning btn-xs" onclick="agregaDatosArticulo('<?php echo $ver[0] ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminaArticulo('<?php echo $ver[0] ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>
<?php endwhile; ?>
</table>