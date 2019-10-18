<?php
include "configs/config.php";
include "configs/funciones.php";
if(!isset($p)){
    $p = "Inicio";
}else{
    $p = $p;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="fontawesome/css/all.css">
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="fontawesome/js/all.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/app.js"></script>



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>productos</title>
</head>
<body>
    <div class="header">
        O.W.T.C
    </div>    
    <div class="menu">
    <a href="?p=inicio">Inicio</a>
    <a href="?p=productos">Productos</a>
    <a href="?p=ofertas">Ofertas</a>
    <a href="?p=carrito">Carrito</a>
    
    <?php
	if(isset($_SESSION['id_cliente'])){
     ?>
    
    <a class="pull-right subir" href="?p=salir">Cerrar sesion</a>    
    <a class="pull-right subir" href="#"><?=nombre_cliente($_SESSION['id_cliente'])?></a>
    
    <?php
	}
    ?>
    </div>
    <div class="cuerpo">
    <?php
        if(file_exists("modulos/" .$p.".php")){
            include "modulos/".$p.".php";
        }else{
            echo "<i>No se ha encontrado el modulo solicitado <b>".$p."</b> <a href='./'>Regresar a la pagina de inicio</a></i>";
        }
    ?>
    </div>
    <div class="footer">
    Derechos Resevados O.W.T.C &copy; <?=date("Y")?>
    </div>
</body>
</html>
