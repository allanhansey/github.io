<?php 

class detalles{

	
	public function obtenDatosProducto($idproducto){
		$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT 
						 precioVenta
					FROM producto
					WHERE idProducto=?";

			$stmt= $conexion->prepare($sql);
			$stmt->bind_param("i", 
							$idproducto);

			$stmt->execute();

			$result = $stmt->get_result(); // get the mysqli result
			$ver = $result->fetch_row(); 

			$datos=array(
					
					"precioVenta" => $ver[0],
						);
   
			return $datos;
	}

	public function crearVenta(){
		$obj=new detalles();
		$c= new conectar();
		$conexion=$c->conexion();
		$idDetalle=self::creaFolio();
		$resultado=self::crearFactura($idDetalle);
		$r=0;
		if( $resultado ==1){

			$datos=$_SESSION['tablaComprasTemp'];
			//print_r ($datos);
			$idempleado=$_SESSION['cedula'];
			 //Respuestas que regresamos
			 $datito=0;
			$total=0;
		
			for ($i=0; $i < count($datos) ; $i++) { 
				$d=explode("||", $datos[$i]);
				$datito=$d[3]*$d[2];
				$descuento=$datito*$d[4];
				$subtotal= $datito - $descuento;
			
				 $sql= "INSERT INTO detallefactura (idDetalle,
													factura_id,
													producto_id,
													cantidad,
													subtotal,
													precioUnit,
													descuento)
									 values (?,?,?,?,?,?,?)";
				$stmt=$conexion->prepare($sql);
				$stmt->bind_param(	"iiiiddd",
									$idDetalle,
									$idDetalle,
									$d[0],
									$d[3],
									$subtotal,
									$d[2],
									$d[4]
								);

				//echo "datos DETALLE: numero= $idDetalle, producto= $d[0], cantidad= $d[3], subtotal= $subtotal, precioUnitario= $d[2], descuento= $d[4]";
				$total=$total+ $subtotal;
				$result=$stmt->execute();
				$r=1;
				

			}
				self::modificarTotalFactura($idDetalle,$total,$d[6]);
		}else{
			return $r;
		}			
		
		return $r;
	}


	public function crearFactura($id){
		$c= new conectar();
		$conexion=$c->conexion();
		$idempleado=$_SESSION['idEmpleado'];
		$fecha=date('Y-m-d');
		$subtotal=0;
		$impuesto=0;
		$total=0;
		$cliente=1;
	    //echo "CLIENTE ANTES DE EJECUTAR SENTENCIA: $cliente";
		$stmt = $conexion->prepare("INSERT INTO factura (numeroFactura,
															empleado_id,
															cliente,
															fecha,
															subtotal,
                                                            impuesto,
                                                            total) 
												VALUES(?,?,?,?,?,?,?)");
				$stmt->bind_param(	"iiisddd",
									$id,
									$idempleado,
									$cliente,
									$fecha,
									$subtotal,
                                    $impuesto,
                                    $total);
	
			if (!$stmt->execute()) {
				echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
				return 0;
			}else{
				return 1;
			}		

				
		

	}

	public function modificarTotalFactura($id,$subtotal,$cliente){
		$c= new conectar();
		$conexion=$c->conexion();
		$impuesto = 0.13 * $subtotal;
		$total = $subtotal+$impuesto;
		$stmt = $conexion->prepare("UPDATE factura SET 	cliente=?,
														subtotal=?,
														impuesto=?,
														total=?
											WHERE numeroFactura=?");
			$stmt->bind_param(	"idddi",
								$cliente,
								$subtotal,
								$impuesto,
								$total,
								$id);

		
			return $stmt->execute();	

	}

	public function creaFolio(){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT MAX(idDetalle) AS idDetalle FROM detallefactura";
	 /*	$stmt=$conexion->prepare($sql);
		$stmt->execute();
		$id=$stmt->get_result();
     */
		$resul=mysqli_query($conexion,$sql);
		$id=mysqli_fetch_row($resul)[0];



		if($id==" " or $id==null or $id==0){
			return 1;
		}else{
			return $id + 1;
		}

	}
	
	public function nombreCliente($idCliente){
		$c= new conectar();
		$conexion=$c->conexion();

		 $sql="SELECT cedula,nombre 
			from cliente
			where cedula='$idCliente'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[0]." ".$ver[1];
	}

	public function obtenerTotal($idventa){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT total
				from factura
				where numeroFactura='$idventa'";
		$result=mysqli_query($conexion,$sql);

		$total=0;

		while($ver=mysqli_fetch_row($result)){
			$total=$total + $ver[0];
		}

		return $total;
	}
}

?>
