<?php 
	session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Empleados.php";

	$obj= new empleados();

	$datos=array(
	$_POST['cedula'],
	$_POST['password']
	);

	

	echo $obj->loginEmpleado($datos);

 ?>