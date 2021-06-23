<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Facturas.php";

	$obj= new facturas();


	$datos=array(
			$_POST['numeroFactura'],
			$_POST['empleado'],
			$_POST['cliente'],
			$_POST['fecha'],
			$_POST['subtotal'],
            $_POST['descuento'],
            $_POST['impuesto'],
            $_POST['total']
				
		);

	echo $obj->agregaFactura($datos);
 ?>