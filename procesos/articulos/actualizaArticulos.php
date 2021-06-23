<?php 

require_once "../../clases/Conexion.php";
require_once "../../clases/Articulos.php";

$obj= new articulos();

$datos=array(
	$_POST['idArticulo'],
	$_POST['descripcionU'],
	$_POST['numeroSerieU'],
	$_POST['precioCompraU'],
	$_POST['precioVentaU'],
);
    echo $obj->actualizaArticulo($datos);

 ?>