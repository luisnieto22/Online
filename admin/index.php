<?php
include "../configs/config.php";
include "../configs/funciones.php";

if(isset($logear)){
  $nombre_usuario = clear($nombre_usuario);
  $password = clear($password);

  $password_encript = sha1(md5($password));

  $q = $mysqli->query("SELECT * FROM admins WHERE nombre_usuario = '$nombre_usuario' AND password = '$password_encript'");

  if(mysqli_num_rows($q)>0){
    $r = mysqli_fetch_array($q);
    $_SESSION['id'] = $r['id'];
    redir("./");
  }else{
    alertadmin("Los datos no son validos");
    redir("./");
  }


}


if(!isset($_SESSION['id'])){
  ?>
  <!DOCTYPE html>
  <html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    <title>Panel Administrador</title>
  </head>
  <body style="background: url(../images/campo.png)";>
     <center>
      <br>
      <br>
       <a href="../index.php">Inicio</a>
        <form style="padding-top:10%;" method="post" action="">
          <div class="centrar_login">
            <label><h1 style="color: brown"><i class="fa fa-key"></i> Iniciar sesion Como Administrador</h1></label>
            <div class="form-group">
              <input style="padding:10px;color:#333;width:40%" type="text" class="form-control" placeholder="Usuario" name="nombre_usuario"/>
            </div>

            <div class="form-group">
              <input style="padding:10px;color:#333;width:40%" type="password" class="form-control" placeholder="Contraseña" name="password"/>
            </div>
            <br><br>

            <div class="form-group">
              <button style="text-decoration:none;
font-weight:600;
font-size:15px;
color:#ffffff;
padding-top:10px;
padding-bottom:10px;
padding-left:30px;
padding-right:30px;
background-color:brown;" name="logear" type="submit"><i class="fa fa-sign-in"></i> Ingresar</button>
            </div>
          </div>
        </form>
      </center>
  </body>
  </html>
  <?php
  die();
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>O.W.T.C</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
   <script src="https://kit.fontawesome.com/06507fdfc0.js"></script>
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>         
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                        <h1 style="color:white";>O.W.T.C</h1>

                    
                    
                </div>
               
                <span class="logout-spn" >		
                <p><?=admin_nombre_connected()?></p>		 
                  <a href="?p=logout" style="color:#fff;">LOGOUT</a>  

                </span>
            </div>
        </div>
       
        
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                    <br>
                     <h2 align="center">Panel Administrador</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="alert alert-info">
                             <h1 align="center">Bienvenido <span class="hidden-xs"><?=admin_nombre_connected()?></span> </h1> <p align="center">Hoy es un excelente dia.</p>
                        </div>
                       <br>
                    </div>
                  </div>  
                   


     
               
                
        <?php
        if(rol_admin($_SESSION['id'])==0){
        ?>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
          <div class="div-square">
          <a href="./?p=agregar_producto">
         <i class="fa fa-wine-bottle fa-5x"></i>
          <h4>Agregar Producto</h4>
          </a>
        </div>
        </div> 


        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
        <div class="div-square">
          <a href="./?p=agregar_categoria">
          <i class="fas fa-layer-group fa-5x"></i>
          <h4>Agregar Categoria</h4>
          </a>
        </div>
        </div>
      
        <?php
        }
        ?>
        

        <?php
        if(rol_admin($_SESSION['id'])==0){
        ?>

<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
          <a href="./?p=manejar_tracking">
          <i class="fas fa-dolly fa-5x"></i>
          <h4>Manejar Traking</h4>
          </a>
        </div>
        </div>

         
         
      
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
          <a href="./?p=pagos">
          <i class="fa fa-money-check-alt fa-5x"></i>
          <h4>Ver Pagos</h4>
          </a>
        </div>
        </div>
        
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
          <a href="./?p=agregar_vendedor">
         <i class="fas fa-male fa-5x"></i>
          <h4>Agregar Vendedor</h4>
          </a>
        </div>
        </div>
        <br>
        <br>
        <br>
        <?php
        }
        ?>

        <?php
        if(rol_admin($_SESSION['id'])==1){
          ?>


             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
          <div class="div-square">
          <a href="./?p=agregar_producto">
         <i class="fa fa-wine-bottle fa-5x"></i>
          <h4>Agregar Producto</h4>
          </a>
        </div>
        </div> 

          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
          <a href="./?p=manejar_productos">
         <i class="fas fa-dollar-sign fa-5x"></i>
          <h4>Productos Vendidos</h4>
          </a>
        </div>
        </div>
       <br>
        <br>
        <br>
          <?php
        }
        ?>
        
    </section>
    <!-- /.sidebar -->
  </aside>

    <?php

    if(!isset($p)){
    ?>

        
      <?php
    }else{
      ?>
      <div style="padding:30px;">
      <?php
      if(file_exists("modulos/".$p.".php")){
        include "modulos/".$p.".php";
      }else{
        echo "El modulo solicitado no existe";
      }
      ?>
    </div>
      <?php
    }
    ?>

</body>
</html>

