<?php 

class empleados{

    public function loginEmpleado($datos){
        $c=new conectar();
        $conexion=$c->conexion();


        $_SESSION['cedula']=$datos[0];
        $_SESSION['idEmpleado']=self::traeID($datos);

        $sql="SELECT * 
                FROM empleado 
            WHERE cedula=?
            AND password=?";
        $stmt= $conexion->prepare($sql);  
        $stmt->bind_param("is",
                        $datos[0],
                        $datos[1]);
        
        $stmt->execute();
        $result = $stmt->get_result();
        $ver=$result->num_rows;

        if($ver > 0){  //si lo encuentra
            return 1;
        }else{
            return 0;
        }
    }

   public function traeID($datos){
        $c=new conectar();
        $conexion=$c->conexion();

        $sql="SELECT idEmpleado 
                FROM empleado 
                WHERE cedula=?
                AND password=?"; 
        
        $stmt=$conexion->prepare($sql);
        $stmt->bind_param("is",
                        $datos[0],
                        $datos[1]);
        $stmt->execute();

        $result = $stmt->get_result();
        $ver=$result->fetch_row();
        return $ver[0];
    }

}

?>