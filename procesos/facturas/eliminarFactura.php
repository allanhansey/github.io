<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Facturas.php";

	$obj= new facturas();

	
	echo $obj->eliminaFactura($_POST['numFactura']);
 ?>