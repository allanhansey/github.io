<?php 
	session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Articulos.php";

	$obj= new articulos();

	$datos=array(
					$_POST['id'],
					$_POST['descripcion'],
					$_POST['numeroSerie'],
					$_POST['precioCompra'],
					$_POST['tipo'],
					$_POST['precioVenta']
					
				
	);

	echo $obj->insertaArticulo($datos);
 ?>