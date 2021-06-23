<?php 
	session_start();
	require_once "../../clases/Conexion.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$idcliente=$_POST['clienteVenta'];
	$idproducto=$_POST['productoVenta'];
	$descuento=$_POST['descuentoV'];
	$cantidad=$_POST['cantidadV'];
	$precio=$_POST['preciounitV'];


	$sql="SELECT nombre 
			from cliente
			where cedula='$idcliente'";
	$result=mysqli_query($conexion,$sql);

	$c=mysqli_fetch_row($result);

	$ncliente=$c[1]." ".$c[0];

	$sql="SELECT descripcion
			from producto
			where idProducto='$idproducto'";
	$result=mysqli_query($conexion,$sql);

	$nombreproducto=mysqli_fetch_row($result)[0];

	$articulo=$idproducto."||". //concatena y luego separa
				$nombreproducto."||".
				$precio."||".
				$cantidad."||".
				$descuento."||".
				$ncliente."||".
				$idcliente;
				

	$_SESSION['tablaComprasTemp'][]=$articulo;

 ?>