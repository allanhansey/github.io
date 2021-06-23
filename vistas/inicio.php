

<?php 
	
	session_start();
	if(isset($_SESSION['cedula'])){ //verifica que la sesion esta llena y muestra
		//la vista
		
		
 ?>


<!DOCTYPE html>
<style>
.pic-ctn {
  width: 100vw;
  height: 200px;
}

@keyframes display {
  0% {
    transform: translateX(200px);
    opacity: 0;
  }
  10% {
    transform: translateX(0);
    opacity: 1;
  }
  20% {
    transform: translateX(0);
    opacity: 1;
  }
  30% {
    transform: translateX(-200px);
    opacity: 0;
  }
  100% {
    transform: translateX(-200px);
    opacity: 0;
  }
}

.pic-ctn {
  position: relative;
  width: 100vw;
  height: 300px;
  margin-top: 15vh;
}

.pic-ctn > img {
  border-radius:5px;
  position: absolute;
  top: 0;
  left: calc(50% - 300px);
  opacity: 0;
  animation: display 10s infinite;
}

img:nth-child(2) {
  animation-delay: 2s;
}
img:nth-child(3) {
  animation-delay: 4s;
}
img:nth-child(4) {
  animation-delay: 6s;
}
img:nth-child(5) {
  animation-delay: 8s;
}
</style>
<html>
<head>
	<title>inicio</title>
	<?php require_once "menu.php";
	 ?>

</head>
<body>

<div class="pic-ctn">
            <img src="https://j2m3x7c3.stackpathcdn.com/wp-content/uploads/2019/09/iphone-11-de-venta-en-Costa-Rica.jpg" style="width:550px;" alt="" class="pic"></img>
            <img src="https://i01.appmifile.com/webfile/globalimg/products/pc/redmi-note-10/specs-header.png" style="width:500px;" alt="" class="pic"></img>
            <img src="https://img.fayerwayer.com/sites/9/2021/04/14/a51-1024x681.jpg" style="width:650px;" alt="" class="pic"></img>
            <img src="https://i2.wp.com/hipertextual.com/wp-content/uploads/2019/10/hipertextual-samsung-galaxy-watch-active2-analisis-mejor-smartwatch-android-2019538432.jpg?fit=2500%2C1500&ssl=1" style="width:750px;" alt="" class="pic"></img>
            <img src="https://i.blogs.es/6a6a20/apple1/450_1000.jpg" style="width:600px;" alt="" class="pic"></img>
</div>
</body>
</html>
<?php 
	}else{
		
		header("location:../index.php");
	}
 ?>