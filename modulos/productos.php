<?php
if(isset($cat)){
	$sc = $mysqli->query("SELECT * FROM categorias WHERE id = '$cat'");
	$rc = mysqli_fetch_array($sc);
	?>
	<h1>Categoria Filtrada por: <?=$rc['categoria']?></h1>
	<?php
}
if(isset($agregar) && isset($cant)){

	$cant_carro = 0;

	$caducidad = time() + ($caducidad_carrito_minutos * 60); //caducidad en segundos


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

		alert("La cantidad agregada sobrepasa la de nuestro inventario.",0,'productos');
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
	alert("Se ha agregado al carro de compras",1,'productos');
	redir("?p=productos");
}
if(isset($busq) && isset($cat)){
	$q = $mysqli->query("SELECT * FROM productos WHERE name like '%$busq%' AND id_categoria = '$cat'");
}elseif(isset($cat) && !isset($busq)){
	$q = $mysqli->query("SELECT * FROM productos WHERE id_categoria = '$cat' ORDER BY id DESC");
}elseif(isset($busq) && !isset($cat)){
	$q = $mysqli->query("SELECT * FROM productos WHERE name like '%$busq%'");
}elseif(!isset($busq) && !isset($cat)){
	$q = $mysqli->query("SELECT * FROM productos ORDER BY id DESC");
}else{
	$q = $mysqli->query("SELECT * FROM productos ORDER BY id DESC");
}
?>
	
	<form method="post" action="">
		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
					<input type="text" class="form-control" name="busq" placeholder="Coloca el nombre del producto"/>
				</div>
			</div>
			<div class="col-md-5">
				<select id="categoria" name="cat"  pal class="form-control">
				<option value="">Seleccione una categoria para filtrar</option>
					<?php
					$cats = $mysqli->query("SELECT * FROM categorias ORDER BY categoria ASC");
					while($rcat = mysqli_fetch_array($cats)){
						?>
						<option value="<?=$rcat['id']?>"><?=$rcat['categoria']?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-prmiary" name="buscar"><i class="fa fa-serch"></i> Buscar</button>
			</div>
		</div>
	</form>
<?php
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
			<div><img class="imagenProducto" src="productos/<?=$r['imagen']?>"/></div>
			<?php
			if($r['oferta']>0){
				?>
				<del><?=$r['precio']?><?=$divisa?> </del> <span class="precio"> <?=$preciototal?> <?=$divisa?> </span>
				<?php
			}else{
				?>
				<span class="precio"><br><?=$r['precio']?> <?=$divisa?></span>
				<?php
			}
			?>
			
			<button class="btn btn-warning pull-right" onclick="agregar_carro('<?=$r['id']?>');"><i class="fa fa-shopping-cart"></i></button>	
			<input type="number" id="cant<?=$r['id']?>" name="cant" class="cant pull-right" value="1"/>	
		</div>
	<?php

}
?>
<script type="text/javascript">
	
	function agregar_carro(idp){
		cant = $("#cant"+idp).val();
		if(cant.length>0){
			window.location="?p=productos&agregar="+idp+"&cant="+cant;
		}
	}
	function redir_cat(){
		window.location="?p=productos&cat="+$("#categoria").val();
	}
</script>