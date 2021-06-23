<?php 
session_start();
if(isset($_SESSION['cedula']) and $_SESSION['cedula']=='admin'){
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Empleados</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Administrar empleados</h1>
			<div class="row">
				<div class="col-sm-7">
					<div id="tablaEmpleadosLoad"></div>
				</div>
			</div>
		</div>
	</body>
	</html>


	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaEmpleadosLoad').load('empleados/tablaEmpleados.php');

			
		});
	</script>

	<?php 
}else{
	header("location:../index.php");
}
?>