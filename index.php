<?php
include "configs/config.php";
include "configs/funciones.php";
	
if(!isset($p)){
	$p = "principal";
}else{
	$p = $p;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="css/estilo.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" href="fontawesome/css/all.css"/>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="fontawesome/js/all.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	

	<title>O.W.T.C</title>
</head>
<body>
    <div class="topnav" id="myTopnav">
	<h1 align="center">Online Wine Trading Center</h1>
	<h2 align="Center">O.W.T.C</h2>
  <a href="?p=principal" class="active">Principal</a>
  <a href="?p=productos">Productos</a>
  <a href="?p=ofertas">Ofertas</a>
  <?php
		if(isset($_SESSION['id_cliente'])){
		?>
		
  <a href="?p=carrito">Mi carrito</a>
  <a href="?p=miscompras">Mis compras</a>
  <?php
		}else{
			?>
				<a href="?p=login">Iniciar Sesion</a>
				<a href="?p=registro">Registrate</a>
				
				 <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    
    <i class="fa fa-bars"></i>
  </a>
				
			<?php
		}
		?>
		
		<?php
		if(isset($_SESSION['id_cliente'])){
		?>
  <a class="botones" href="?p=salir">Salir</a>
  <a class="botones1"href="#about"><?=nombre_cliente($_SESSION['id_cliente'])?></a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    
    <i class="fa fa-bars"></i>
  </a>
  <?php
		}
		?>
</div>
	<div class="cuerpo">
		<?php
			if(file_exists("modulos/".$p.".php")){
				include "modulos/".$p.".php";
			}else{
				echo "<i>No se ha encontrado el modulo <b>".$p."</b> <a href='./'>Regresar</a></i>";
			}
		?>
	</div>

	<div class="carritot" onclick="minimizer()">
		 <p align="center">Carrito de compra</p>
	<input type="hidden" id="minimized" value="0"/>
	</div>

	<div class="carritob">

		<table class="table table-striped">
	<tr>
		<th>Nombre del producto</th>
		<th>Cantidad</th>
		<th>Precio </th>
	</tr>
	

	
	
<?php

if(isset($_SESSION['id_cliente'])){

$id_cliente = clear($_SESSION['id_cliente']);
$q = $mysqli->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente'");
$monto_total = 0;
while($r = mysqli_fetch_array($q)){
	$q2 = $mysqli->query("SELECT * FROM productos WHERE id = '".$r['id_producto']."'");
	$r2 = mysqli_fetch_array($q2);
	$preciototal = 0;
			if($r2['oferta']>0){
				if(strlen($r2['oferta'])==1){
					$desc = "0.0".$r2['oferta'];
				}else{
					$desc = "0.".$r2['oferta'];
				}
				$preciototal = $r2['precio'] -($r2['precio'] * $desc);
			}else{
				$preciototal = $r2['precio'];
			}
	$nombre_producto = $r2['name'];
	$cantidad = $r['cant'];
	$precio_unidad = $r2['precio'];
	$precio_total = $cantidad * $preciototal;
	$imagen_producto = $r2['imagen'];
	$monto_total = $monto_total + $precio_total;
	
	?>
		<tr>
			<td><?=$nombre_producto?></td>
			<td><?=$cantidad?></td>
			<td><?=$precio_unidad?> <?=$divisa?></td>
		</tr>
	<?php
}
}else{
	$monto_total = 0;
}
?>
</table>
<span>Monto Total: <b class="text-green"><?=$monto_total?> <?=$divisa?></b></span>

<br><br>
<form method="post" action="?p=carrito">
	<input type="hidden" name="monto_total" value="<?=$monto_total?>"/>
	<button class="btn btn-primary" type="submit" name="finalizar"><i class="fa fa-check"></i> Finalizar Compra</button>
</form>
	</div>
 <footer>
       
       <div class="container-footer-all">
        
            <div class="container-body">

                <div class="colum1">
                    <h1>Mas información de la compañia</h1>

                    <p>Esta compañia se dedica a la venta de vinos por medio de las tecnologías
                    de la información y la comunicación,
                    empleando herramientas avanzadas de prgramación web.</p>

                </div>

                <div class="colum2">

                    <h1>Redes Sociales</h1>

                    <div class="row">
                        <img src="icon/facebook.png">
                        <label>Síguenos en Facebook</label>
                    </div>
                    <div class="row">
                        <img src="icon/twitter.png">
                        <label>Síguenos en Twitter</label>
                    </div>
                    <div class="row">
                        <img src="icon/insta.png">
                        <label>Síguenos en Instagram</label>
                    </div>         
                </div>

                <div class="colum3">

                    <h1>Información de Contácto</h1>

                    <div class="row2">
                        <img src="icon/house1.png">
                        <label>Cancún Qroo,
                        México.Paraíso Maya,
                        Av. Arrecifes
                        Sm107.</label>
                    </div>

                    <div class="row2">
                        <img src="icon/iphone.png">
                        <label>(044)7441591404</label>
                    </div>

                    <div class="row2">
                        <img src="icon/contact.png">
                         <label>consejomx@wine-trading.com.mx</label>
                    </div>

                </div>

            </div>
        
        </div>
        
        <div class="container-footer">
               <div class="footer">
                    <div class="copyright">
                        © 2019 Todos los Derechos Reservados por O.W.T.C | <a href="img src="icon/logo.jpeg""></a>
                    </div>
                </div>

            </div>
        
    </footer>
    


</body>

</html>

<script type="text/javascript">
	
	function minimizer(){
		var minimized = $("#minimized").val();
		if(minimized == 0){
			//mostrar
			$(".carritot").css("bottom","350px");
			$(".carritob").css("bottom","0px");
			$("#minimized").val('1');
		}else{
			//minimizar
			$(".carritot").css("bottom","0px");
			$(".carritob").css("bottom","-350px");
			$("#minimized").val('0');
		}
	}
</script>
<script type="text/javascript">
// Call carousel manually
$('#myCarouselCustom').carousel();

// Go to the previous item
$("#prevBtn").click(function(){
    $("#myCarouselCustom").carousel("prev");
});
// Go to the previous item
$("#nextBtn").click(function(){
    $("#myCarouselCustom").carousel("next");
});
</script>
<script>
    function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>