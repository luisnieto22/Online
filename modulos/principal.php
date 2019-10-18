
<main>
       <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
  <div class="carousel-inner">
    <div class="item active">
      <img src="images/vino1.png" class="d-block w-100" alt="...">
    </div>
    <div class="item">
      <img src="images/slide.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="item">
      <img src="images/campo2.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
 

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
       <br>
       <br>
        <section id="bienvenidos">
            <div class="contenedor">
                <h2>BIENVENIDOS A O.W.T.C</h2>         
                <p>Tu mejor opcion en bebidas alcoholicas vendida por los mejores exponentes del mercado </p>
            </div>
    </section>

    <section id="blog">
            <h3>Lo último de nuestra tienda</h3>
            <div class="contenedor">
                <article>
                    <img src="images/blog2.jpg">
                    <h4>Vinos</h4>
                    </article>
                 <article>
                    <img src="images/blog.bmp">
                    <h4>Tipos de vinos</h4>
                 </article>
                <article>
                    <img src="images/temperatura-ideal-vino.jpg">
                    <h4>Nuevos productos</h4>
                </article>
            </div>
    </section>

            <section id="info">
                <h3>Algunos de nuestros productos</h3>
                <div class="contenedor">
                    <div class="info-pet">
                        <img src="images/tiposdevino%20(1).jpeg" alt="">
                        <h4>Vino Tinto</h4>
                    </div>
                    <div class="info-pet">
                        <img src="images/tipodevino11.jpeg" alt="">
                        <h4>Vino Blanco</h4>
                    </div>
                    <div class="info-pet">
                        <img src="images/tiposdevino%20(6).jpeg" alt="">
                        <h4>Vino Rosado</h4>
                    </div>
                    <div class="info-pet">
                        <img src="images/tiposdevino%20(4).jpeg" alt="">
                        <h4>Otros</h4>
                    </div>
                </div>
            </section>

            <section class="empresas">
              <h3>EMPRESAS COLABORATIVAS</h3>
               <div class="contenedor">
               <div class="em">
                   <img src="images/empresa1.jpg" alt="">
               </div>
               <div class="em">
                   <img src="images/empresa2.webp" alt="">
               </div>
               <div class="em">
                   <img src="images/empresa4.png" alt="">
               </div>
               <div class="em">
                   <img src="images/empresa5.png" alt="">
               </div>
              </div>
            </section>
        </main>




<?php
if(isset($agregar) && isset($cant)){

	if(!isset($_SESSION['id_cliente'])){
		redir("?p=login");
	}


	$caducidad = time() + ($caducidad_carrito_minutos * 60); //caducidad en segundos

	$cant_carro = 0;


	$idp = clear($agregar);
	$cant = clear($cant);

	$cs = $mysqli->query("SELECT * FROM productos WHERE id = '$idp'");
	$rc = mysqli_fetch_array($cs);

	$cs2 = $mysqli->query("SELECT * FROM carro WHERE id_producto = '$idp' AND id_cliente = '".$_SESSION['id_cliente']."'");
	$rc2 = mysqli_fetch_array($cs2);
	$cant_carro = $rc2['cant'];
	$cant_stock = $rc['instock'];

	$cant_total = $cant + $cant_carro;



	if($cant_total>$cant_stock){

		alert("La cantidad agregada sobrepasa la de nuestro inventario.",0,'principal');
		die();
		
	}

	


	$id_cliente = clear($_SESSION['id_cliente']);
	$v = $mysqli->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");
	if(mysqli_num_rows($v)>0){
		$q = $mysqli->query("UPDATE carro SET cant = cant + $cant, caducidad = $caducidad WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");
	
	}else{
		$q = $mysqli->query("INSERT INTO carro (id_cliente,id_producto,cant,caducidad) VALUES ($id_cliente,$idp,$cant,$caducidad)");
	}

	$mysqli->query("UPDATE productos SET instock = instock - $cant WHERE id = $idp");
	alert("Se ha agregado al carro de compras",1,'principal');
	//redir("?p=principal");
}
?>
<h1>Botellas Mas Nuevas del Mercado</h1><br><br>
<div style="display: flex;flex-wrap: wrap;justify-content: center;align-items: center;">
<?php
$q = $mysqli->query("SELECT * FROM productos WHERE oferta = 0 ORDER BY id DESC LIMIT 10");
while($r=mysqli_fetch_array($q)){
	$preciototal = 0;
			if($r['oferta']>0){
				if(strlen($r['oferta'])==1){
					$desc = "0.0".$r['oferta'];
				}else{
					$desc = "0.".$r['oferta'];
				}
				$preciototal = $r['precio'] -($r['precio'] * $desc);
			}else{
				$preciototal = $r['precio'];
			}
	?>
		<div class="producto" style="position: relative">
			<div style="position:absolute;right:18px;top:15px;background:#333;border-radius: 0px 20px 20px 20px;padding-left:10px;padding-right:10px; color:#fff;"><span id="disp" style="color:#f80;"><?=$r['instock']?></span> Disponibles</div>
			<div class="nombre_producto"><?=$r['name']?></div>
			<div><img class="imagenProducto" src="productos/<?=$r['imagen']?>"/></div>
			<?php
			if($r['oferta']>0){
				?>
				<del><?=$r['precio']?> <?=$divisa?></del> <span class="precio"> <?=$preciototal?> <?=$divisa?> </span>
				<?php
			}else{
				?>
				<span class="precio"><br><?=$r['precio']?> <?=$divisa?></span>
				<?php
			}
			?>
			
			<button class="btn btn-warning pull-right" onclick="agregar_carro('<?=$r['id']?>');" style="border-radius:0px 4px 4px 0px"><i class="fa fa-shopping-cart"></i></button>
			<input type="number" id="cant<?=$r['id']?>" name="cant" class="cant pull-right" value="1"/>
		</div>
	<?php
}
?>
</div>
<h1>Mejores Ofertas Actuales</h1><br><br>

<div style="display: flex;flex-wrap: wrap;justify-content: center;align-items: center;">
<?php
	$q = $mysqli->query("SELECT * FROM productos WHERE oferta>0 ORDER BY id DESC LIMIT 6");
	while($r=mysqli_fetch_array($q)){
	$preciototal = 0;
			if($r['oferta']>0){
				if(strlen($r['oferta'])==1){
					$desc = "0.0".$r['oferta'];
				}else{
					$desc = "0.".$r['oferta'];
				}
				$preciototal = $r['precio'] -($r['precio'] * $desc);
			}else{
				$preciototal = $r['precio'];
			}
	?>
		<div class="producto" style="position: relative;">
			<div style="position:absolute;right:18px;top:15px;background:#333;border-radius: 0px 20px 20px 20px;padding-left:10px;padding-right:10px; color:#fff;"><span id="disp" style="color:#f80;"><?=$r['instock']?></span> Disponibles</div>
			<div class="nombre_producto"><?=$r['name']?></div>
			<div><img class="imagenProducto" src="productos/<?=$r['imagen']?>"/></div><br>
			<del><?=$r['precio']?> <?=$divisa?></del> <span class="precio"> <?=$preciototal?> <?=$divisa?> </span>
			
			<button class="btn btn-warning pull-right" onclick="agregar_carro('<?=$r['id']?>');" style="border-radius:0px 4px 4px 0px"><i class="fa fa-shopping-cart"></i></button>
			
			<input type="number" id="cant<?=$r['id']?>" name="cant" class="cant pull-right" value="1"/>
		</div>
	<?php
}

?>
</div>
<script type="text/javascript">
	
	function agregar_carro(idp){
		cant = $("#cant"+idp).val();
		if(cant.length>0){
			window.location="?p=principal&agregar="+idp+"&cant="+cant;
		}
	}
</script>
<script type="text/javascript">
$('.carousel').carousel({
     interval: 8000,
     pause:true,
     wrap:false
});
</script>