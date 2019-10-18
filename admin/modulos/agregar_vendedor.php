<?php
check_admin();

if(rol_admin($_SESSION['id'])!=0){
	redir("./");/*aqui hace una validacion de roles en donde tenemos 0,1 donde 0 es el admin conmayor privilegio y 1 es el vendedor */
}

if(isset($enviar)){
	$nombre_usuario = clear($nombre_usuario);
	$password = clear($password);
	$password_encrypt = sha1(md5($password));
	$nombre = clear($nombre);
	$s = $mysqli->query("SELECT * FROM admins WHERE nombre_usuario = '$nombre_usuario'");
	if(mysqli_num_rows($s)>0){
		alert("Ya este usuario se encuentra registrado",0,'agregar_vendedor');
		redir("");
	}else{
		$mysqli->query("INSERT INTO admins (nombre_usuario,password,nombre,rol) VALUES ('$nombre_usuario','$password_encrypt','$nombre',1)");
		alert("Vendedor Agregado",1,'agregar_vendedor');
		redir("");
	}
}
if(isset($eliminar)){
	$eliminar = clear($eliminar);
	$mysqli->query("DELETE FROM admins WHERE id = '$eliminar'");
	alert("Vendedor eliminado",1,'agregar_vendedor');
	redir("?p=agregar_vendedor");
}
?>
<br>
<br>
<h1>Agregar Vendedor</h1>

<form method="post" action="">
	<div class="form-group">
		<input type="text" class="form-control" name="nombre_usuario" placeholder="Usuario"/>
	</div>
	<div class="form-group">
		<input type="password" class="form-control" name="password" placeholder="Contraseña"/>
	</div>
	<div class="form-group">
		<input type="text" class="form-control" name="nombre" placeholder="Nombre"/>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="enviar" value="Agregar vendedor"/>
	</div>
</form><br>

<br>

<table class="table table-striped">
	<tr>
		<th>ID</th>
		<th>Usuario</th>
		<th>Nombre</th>
		<th>Acciones</th>
	</tr>

	<?php
	$q = $mysqli->query("SELECT * FROM admins WHERE rol = 1");
	while($r=mysqli_fetch_array($q)){
		?>
			<tr>
				<td><?=$r['id']?></td>
				<td><?=$r['nombre_usuario']?></td>
				<td><?=$r['nombre']?></td>
				<td>
					<a href="?p=agregar_vendedor&eliminar=<?=$r['id']?>"><i data-toggle="tooltip" title="Eliminar" class="fa fa-times"></i></a>
				</td>
			</tr>
		<?php
	}
	?>
</table>