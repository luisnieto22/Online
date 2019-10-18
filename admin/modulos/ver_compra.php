<?php
check_admin();
$id = clear($id);

$s = $mysqli->query("SELECT * FROM compra WHERE id = '$id'");


$r = mysqli_fetch_array($s);
$sc = $mysqli->query("SELECT * FROM clientes WHERE id = '".$r['id_cliente']."'");
$rc = mysqli_fetch_array($sc);
$nombre = $rc['name'];
?>
<br>
<br>
<h1>Viendo compra de <span style="color:#08f"><?=$nombre?></span></h1><br>

Fecha: <?=fecha($r['fecha'])?><br>
Monto: <?=number_format($r['monto'])?> <?=$divisa?><br>
Estado: <?=estado($r['estado'])?><br>
<br>
<table class="table table-striped">
	<tr>
		<th>Nombre del producto</th>
		<th>Cantidad</th>
		<th>Monto</th>
		<th>Monto Total</th>
	</tr>
	<?php
		if(rol_admin($_SESSION['id'])==0){
			$sp = $mysqli->query("SELECT * FROM productos_compra WHERE id_compra = '$id'");
		}else{
			$sp = $mysqli->query("SELECT * FROM productos_compra WHERE id_compra = '$id' AND id_vendedor = '".$_SESSION['id']."'");
		}
		while($rp=mysqli_fetch_array($sp)){
			$spro = $mysqli->query("SELECT * FROM productos WHERE id = '".$rp['id_producto']."'");
			$rpro = mysqli_fetch_array($spro);
			$nombre_producto = $rpro['name'];
			$montototal = $rp['monto'] * $rp['cantidad'];
			?>
				<tr>
					<td><?=$nombre_producto?></td>
					<td><?=$rp['cantidad']?></td>
					<td><?=$rp['monto']?></td>
					<td><?=$montototal?></td>
				</tr>
			<?php
		}
	?>
</table>