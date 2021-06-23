<?php 

	session_start();
	
 ?>

 <h4><strong><div id="nombreclienteVenta"></div></strong></h4>
 <table class="table table-bordered table-hover table-condensed" style="text-align: center;">
 
 	<tr>
 		<td>#Id Producto</td>
		<td>Descripcion</td>
 		<td>Precio Unitario</td>
		<td>Cantidad</td>
 		<td>Quitar</td>
 	</tr>
 	<?php 
	 $total=0;
 	//esta variable tendra el total de la compra en dinero
 	$cliente=""; //en esta se guarda el nombre del cliente
 		if(isset($_SESSION['tablaComprasTemp'])):
 			$i=0;
 			foreach (@$_SESSION['tablaComprasTemp'] as $key) {

 				$d=explode("||", @$key); //variable entorno
				 //si trae algo   , revisa que
 	 ?>

 	<tr>
 		<td><?php echo $d[0] ?></td>
 		<td><?php echo $d[1] ?></td>
 		<td><?php echo $d[2] ?></td>
		<td><?php echo $d[3] ?></td>
		
 		<td>
 			<span class="btn btn-danger btn-xs" onclick="quitarP('<?php echo $i; ?>')">
 				<span class="glyphicon glyphicon-remove"></span>
 			</span>
 		</td>
 	</tr>

 <?php 
 		$total=$total + $d[2];
 		$i++;
 		$cliente=$d[5];
 	}
 	endif; 
	
 ?>

 	<tr>
 		<td>Total de venta: <?php echo "$".$total; ?></td>
 	</tr>

	 
 </table>
 <caption>
 		<span class="btn btn-success" onclick="crearVenta()"> Generar Factura
 			<span class="glyphicon glyphicon-usd"></span>
 		</span>
	</caption>

 <script type="text/javascript">
 	$(document).ready(function(){
		
 		nombre="<?php echo @$cliente ?>";
 		$('#nombreclienteVenta').text("Cliente: " + nombre);
 	});
 </script>