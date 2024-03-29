<?php
check_admin();
$id = clear($id);
$q = $mysqli->query("SELECT * FROM productos WHERE id = '$id'");
$rq = mysqli_fetch_array($q);
if(isset($enviar)){
	$idpro = clear($idpro);
	$name = clear($name);
	$precio = clear($precio);
	$categoria = clear($categoria);
	$oferta = clear($oferta);
	$instock = clear($instock);
	$mysqli->query("UPDATE productos SET name = '$name',precio = '$precio',id_categoria = '$categoria', oferta = '$oferta', instock = '$instock' WHERE id = '$idpro'");
	redir("?p=agregar_producto");

}
?>
<br>
<br>
<h1>Modificar Producto Seleccionado</h1>
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<input data-toggle="tooltip" title="Nombre del producto" type="text" class="form-control" name="name" value="<?=$rq['name']?>" placeholder="Nombre del producto"/>
	</div>


	<div class="form-group">
		<input data-toggle="tooltip" title="Precio del producto" type="text" class="form-control" name="precio" value="<?=$rq['precio']?>" placeholder="Precio del producto"/>
	</div>


	<div class="form-group">
		<input data-toggle="tooltip" title="Cantidad en inventario" type="text" class="form-control" name="instock" value="<?=$rq['instock']?>" placeholder="Cantidad en inventario"/>
	</div>

	<div class="form-group">

		<select data-toggle="tooltip" title="Categoria" name="categoria" required class="form-control">
			<option value="">Seleccione una categoria</option>
			<?php
				$q = $mysqli->query("SELECT * FROM categorias ORDER BY categoria ASC");
				while($r=mysqli_fetch_array($q)){
					?>
						<option <?php if($rq['id_categoria'] == $r['id']) { echo "selected"; } ?>  value="<?=$r['id']?>"><?=$r['categoria']?></option>
					<?php
				}
			?>
		</select>

	</div>

	<div class="form-group">
		<select data-toggle="tooltip" title="Oferta" name="oferta" class="form-control">
			<option <?php if($rq['oferta'] == 0) { echo "selected"; }?> value="0">0% de Descuento</option>
			<option <?php if($rq['oferta'] == 5) { echo "selected"; }?> value="5">5% de Descuento</option>
			<option <?php if($rq['oferta'] == 10) { echo "selected"; }?> value="10">10% de Descuento</option>
			<option <?php if($rq['oferta'] == 15) { echo "selected"; }?> value="15">15% de Descuento</option>
			<option <?php if($rq['oferta'] == 20) { echo "selected"; }?> value="20">20% de Descuento</option>
			<option <?php if($rq['oferta'] == 25) { echo "selected"; }?> value="25">25% de Descuento</option>
			<option <?php if($rq['oferta'] == 30) { echo "selected"; }?> value="30">30% de Descuento</option>
			<option <?php if($rq['oferta'] == 35) { echo "selected"; }?> value="35">35% de Descuento</option>
			<option <?php if($rq['oferta'] == 40) { echo "selected"; }?> value="40">40% de Descuento</option>
			<option <?php if($rq['oferta'] == 45) { echo "selected"; }?> value="45">45% de Descuento</option>
			<option <?php if($rq['oferta'] == 50) { echo "selected"; }?> value="50">50% de Descuento</option>
			<option <?php if($rq['oferta'] == 55) { echo "selected"; }?> value="55">55% de Descuento</option>
			<option <?php if($rq['oferta'] == 60) { echo "selected"; }?> value="60">60% de Descuento</option>
			<option <?php if($rq['oferta'] == 65) { echo "selected"; }?> value="65">65% de Descuento</option>
			<option <?php if($rq['oferta'] == 70) { echo "selected"; }?> value="70">70% de Descuento</option>
			<option <?php if($rq['oferta'] == 75) { echo "selected"; }?> value="75">75% de Descuento</option>
			<option <?php if($rq['oferta'] == 80) { echo "selected"; }?> value="80">80% de Descuento</option>
			<option <?php if($rq['oferta'] == 85) { echo "selected"; }?> value="85">85% de Descuento</option>
			<option <?php if($rq['oferta'] == 90) { echo "selected"; }?> value="90">90% de Descuento</option>
			<option <?php if($rq['oferta'] == 95) { echo "selected"; }?> value="95">95% de Descuento</option>
			<option <?php if($rq['oferta'] == 99) { echo "selected"; }?> value="99">99% de Descuento</option>
		</select>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-success" name="enviar"><i class="fa fa-check"></i> Modificar Producto</button>
	</div>


<input type="hidden" name="idpro" value="<?=$id?>"/>

</form>