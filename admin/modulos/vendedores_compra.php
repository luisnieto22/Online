<?php
check_admin();

//Estados:
//0 Sin verificar
//1 Verificado
//2 Reembolso
?>
<br>
<br>
<h1>Compras realizadas</h1>

<table class="table table-striped">
	<tr>
		<th>Cliente</th>
		<th>Fecha</th>
		<th>Estado</th>
		<th>Acciones</th>
	</tr>

	<?php
	$s = $mysqli->query("SELECT * FROM productos_compra WHERE id_vendedor = '".$_SESSION['id']."' GROUP BY id_compra");
	while($r=mysqli_fetch_array($s)){
		$sc = $mysqli->query("SELECT * FROM compra WHERE id = '".$r['id_compra']."'");
		while($rc=mysqli_fetch_array($sc)){
		?>
		<tr>
			<td><?=nombre_cliente($rc['id_cliente'])?></td>
			<td><?=fecha($rc['fecha'])?></td>
			
			<td><?=estado_pago($rc['estado'])?></td>
			<td>
				<a style="color:#333" href="?p=ver_compra&id=<?=$rc['id']?>"><i class="fa fa-eye" title="Ver Compra"></i></a>
			</td>
		</tr>
		<?php
		}
	}
	?>
</table>
