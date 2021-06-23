<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Clientes.php";

	$obj= new clientes();


	$datos=array(
			$_POST['cedula'],
			$_POST['nombre'],
			$_POST['telefono'],
			$_POST['direccion'],
			$_POST['correo']
				
		);

	echo $obj->agregaCliente($datos);
 ?>