<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Clientes.php";

	$obj= new clientes();


	$datos=array(
			$_POST['cedulaU'],
			$_POST['nombreU'],
			$_POST['telefonoU'],
			$_POST['direccionU'],
			$_POST['correoU'],
			
			);

	echo $obj->actualizaCliente($datos);

	
	
 ?>