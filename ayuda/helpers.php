

//menu de cabecera 
https://bootsnipp.com/snippets/Kr5yV


<style type="text/css">
		
@page {
            margin-top: 0.3em;
            margin-left: 0.6em;
        }
	</style>

<script type="text/javascript">

	//script para evento click y ajax 
	$('#').click(function(){

		datos=$('#').serialize();
		$.ajax({
			type:"POST",
			data:datos,
			url:"../procesos/",
			success:function(r){

			}
		});
	});
//////////////funcion para validar datos vacios :)
	function validarFormVacio(formulario){
		datos=$('#' + formulario).serialize();
		d=datos.split('&');
		vacios=0;
		for(i=0;i< d.length;i++){
				controles=d[i].split("=");
				if(controles[1]=="A" || controles[1]==""){
					vacios++;
				}
		}
		return vacios;
	}

</script>

<script type="text/javascript">
		$('#').click(function(){
			var formData = new FormData(document.getElementById("frm"));

				$.ajax({
					url: "../procesos/articulos/insertaArchivo.php",
					type: "post",
					dataType: "html",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,

					success:function(data){
						
						if(data == 1){
							$('#frm')[0].reset();
							$('#tablaArticulos').load('articulos/tablaArticulos.php');
							alertify.success("Agregado con exito :D");
						}else{
							alertify.error("Fallo al subir el archivo :(");
						}
					}
				});
		});
</script>

<?php 



	///***************************************
	 function nombreClientegg($idCliente){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT cedula,nombre 
			from clientes 
			where cedula='$idCliente'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[0]." ".$ver[1];
	}

	function obtenerTotal($idventa){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT precio 
				from ventas 
				where id_venta='$idventa'";
		$result=mysqli_query($conexion,$sql);

		$total=0;

		while($ver=mysqli_fetch_row($result)){
			$total=$total + $ver[0];
		}

		return $total;
	}

 ?>