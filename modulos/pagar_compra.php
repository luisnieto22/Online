<?php
check_user('pagar_compra');
if(isset($subir)){
	$nombre = clear($nombre);
	$comprobante = "";
	if(is_uploaded_file($_FILES['comprobante']['tmp_name'])){
		$comprobante = date("His").rand(0,1000).".png";
		move_uploaded_file($_FILES['comprobante']['tmp_name'], "comprobantes/".$comprobante);
	}
	$mysqli->query("INSERT INTO pagos (id_cliente,id_compra,comprobante,nombre,fecha) VALUES ('".$_SESSION['id_cliente']."','$id','$comprobante','$nombre',NOW())");
	alert("Comprobante enviado",1,'miscompras');
	//redir("?p=miscompras");
}
	
?>

<h1>Metodos de pago</h1>

<table class="table table-striped">
<tr>
	<th>Tipo de pago</th>
	<th>Cuenta</th>
	<th>Beneficiario</th>
	<th>Acciones</th>
</tr>

<tr>
	<td>Transferencia Bancaria</td>
	<td>4910-8970-5879-3480</td>
	 <td>Consejo Quintanarroense Vitivinicola/td>
	<th><a target="_blank" href="https://www.hsbc.com.mx/digital/transferencias_express/"> Ir al pago </a></th>
</tr>
</table>

<h1>Envia el comprobante de pago de la compra</h1>

<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<label><small>Adjuntar comprobante</small></label>
		<input type="file" class="form-control" name="comprobante" title="Adjuntar Comprobante" required/>
	</div>
	<div class="form-group">
		<input type="text" class="form-control" name="nombre"  required title="Nombre de la persona que transfiere"/>
	</div>
	<div class="form-group">
		<input type="submit" name="subir" class="btn btn-primary" value="Enviar"/>
	</div>
</form>