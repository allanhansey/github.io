<?php 
	
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Detalles.php";

	$obj= new detalles();

	echo json_encode($obj->obtenDatosProducto($_POST['idproducto']))

 ?>