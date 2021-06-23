
<?php 
	class especificaciones{

		public function insertaEspecificaciones($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$stmt = $conexion->prepare("INSERT INTO especificaciones (producto_id,
																	pantalla,
																	almacenamiento,
																	procesador,
																	bateria,
																	camara) 
												VALUES(?,?,?,?,?,?)");
				$stmt->bind_param(	"isssss",
									$datos[5],
									$datos[0],
									$datos[1],
									$datos[2],
									$datos[3],
									$datos[4]);
				
				return $stmt->execute();	
			
			}


    }
	


?>