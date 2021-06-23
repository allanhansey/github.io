<?php 

	class clientes{

		public function agregaCliente($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$stmt = $conexion->prepare("INSERT INTO cliente (cedula,
															nombre,
															telefono,
															direccion,
															correo) 
												VALUES(?,?,?,?,?)");
				$stmt->bind_param(	"issss",
									$datos[0],
									$datos[1],
									$datos[2],
									$datos[3],
									$datos[4]);
	
				return $stmt->execute();	
			
		}
	

		public function obtenDatosCliente($idCliente){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT cedula, 
						 nombre,
						 telefono,
						 direccion,
						 correo 
					FROM cliente 
					WHERE cedula=?";

			$stmt= $conexion->prepare($sql);
				$stmt->bind_param("i", 
								$idCliente);

				$stmt->execute();

			$result = $stmt->get_result(); // get the mysqli result
			$ver = $result->fetch_row(); 
			
			$datos=array(
					'cedula' => $ver[0], 
					'nombre' => $ver[1],
					'telefono' => $ver[2],
					'direccion' => $ver[3],
					'correo' => $ver[4]
		
						);

			return $datos;
		}

		public function actualizaCliente($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$stmt = $conexion->prepare("UPDATE cliente SET nombre=?,
															telefono=?,
															direccion=?,
															correo=? 
												WHERE cedula=?");
				$stmt->bind_param(	"ssssi",
									$nombre,
									$telefono,
									$direccion,
									$correo,
									$cedula);

				$cedula=$datos[0];
				$nombre=$datos[1];
				$telefono=$datos[2];
				$direccion=$datos[3];
				$correo=$datos[4];
	
				return $stmt->execute();	
	
		}

		public function eliminaCliente($idCliente){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="DELETE FROM cliente WHERE cedula=?";
			$stmt = $conexion->prepare($sql);
			$stmt->bind_param(	"i",
								$idCliente);

			return $stmt->execute();
		
		}
	
	}


?>


	