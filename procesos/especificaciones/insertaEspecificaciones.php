<?php 
	session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Especificaciones.php";

	$obj= new especificaciones();

	$datos=array(
					
					$_POST['pantalla'],
					$_POST['almacenamiento'],
					$_POST['procesador'],
					$_POST['bateria'],
                    $_POST['camara'],
					$_POST['NonFormValue']
				
	);

	echo $obj->insertaEspecificaciones($datos);
 ?>