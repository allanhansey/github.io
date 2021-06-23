<?php 

	class facturas{

	/*	public function agregaFactura($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$stmt = $conexion->prepare("INSERT INTO factura (numeroFactura,
															empleado_id,
															cliente,
															fecha,
															subtotal,
                                                            descuento,
                                                            impuesto,
                                                            total) 
												VALUES(?,?,?,?,?,?,?,?)");
				$stmt->bind_param(	"iiisdddd",
									$datos[0],
									$datos[1],
									$datos[2],
									$datos[3],
									$datos[4],
                                    $datos[5],
                                    $datos[6],
                                    $datos[7]);
	
				return $stmt->execute();	
			
		}

*/
		public function eliminaFactura($numFactura){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="DELETE FROM factura WHERE numeroFactura=?";
			$stmt = $conexion->prepare($sql);
			$stmt->bind_param(	"i",
								$numFactura);
												//ESO MI AMOR
			return $stmt->execute();

		}
	}

 ?>