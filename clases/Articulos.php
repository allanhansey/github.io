
<?php 
	class articulos{
		
		public function insertaArticulo($datos){
			$c=new conectar();
			$conexion=$c->conexion();
			$num=1;


			$stmt=$conexion->prepare("INSERT INTO producto (idProducto,
															descripcion,
															numero_serie,
															precioCompra,
															tipo,
															precioVenta,
															Proveedor) 
												VALUES (?,?,?,?,?,?,?)");
			$stmt->bind_param(	"issdsdi",
								$datos[0],
								$datos[1],
								$datos[2],
								$datos[3],
								$datos[4],
								$datos[5],
								$num);

			return $stmt->execute();
		}

		public function obtenDatosArticulo($idarticulo){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT idProducto,
						 descripcion,
						 numero_serie,
						 precioCompra,
						 precioVenta
					FROM producto
					WHERE idProducto=?";

			$stmt= $conexion->prepare($sql);
			$stmt->bind_param("i", 
							$idarticulo);

			$stmt->execute();

			$result = $stmt->get_result(); // get the mysqli result
			$ver = $result->fetch_row(); 

			$datos=array(
					"idProducto" => $ver[0],
					"descripcion" => $ver[1],
					"numero_serie" => $ver[2],
					"precioCompra" => $ver[3],
					"precioVenta" => $ver[4],
						);

			return $datos;
		}

		public function actualizaArticulo($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE producto set descripcion=?, 
										numero_serie=?,
										precioCompra=?,
										precioVenta=?
						where idProducto=?";
			$stmt=$conexion->prepare($sql);
			$stmt->bind_param(	"ssddi",
								$datos[1],
								$datos[2],
								$datos[3],
								$datos[4],
								$datos[0]
								);
			return $stmt->execute();
		}

	
		public function eliminaArticulo($idarticulo){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="DELETE FROM producto WHERE idProducto=?";
			$stmt = $conexion->prepare($sql);
			$stmt->bind_param(	"i",
								$idarticulo);

			return $stmt->execute();
		
		}
	
	}

 ?>