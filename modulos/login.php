<?php
	if(isset($_SESSION['id_cliente'])){
		redir("./");
	}
if(isset($enviar)){
	$pdo = conpdo();
	$usuario_nombre = clear($usuario_nombre);
	$password = clear($password);
	$password_encript = sha1(md5($password));
	$query = $pdo->prepare("SELECT * FROM clientes WHERE usuario_nombre = :usuario_nombre AND password = :password");
	$query->bindParam("usuario_nombre",$usuario_nombre,PDO::PARAM_STR);
	$query->bindParam("password",$password_encript,PDO::PARAM_STR);
	$query->execute();
	$result = $query->rowCount();
	if($result>0){
		$row = $query->fetch(PDO::FETCH_ASSOC);
		$_SESSION['id_cliente'] = $row['id'];
		if(isset($return)){
			redir("?p=".$return);
		}else{
			redir("./");
		}
	}else{
		alert("Los datos no son validos",0,"login");
	}
}
	?>
	<center>
		<form method="post" action="">
			<div class="centrar-login">
				<label><h2><i class="fa fa-key"></i> Iniciar Sesion</h2></label>
				<div class="form-group">
					<input type="text" autocomplete="off" class="form-control" placeholder="Usuario" required name="usuario_nombre"/>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Contraseña" required name="password"/>
				</div>
				<div class="form-group">
					<button style="
text-decoration:none;
font-weight:600;
font-size:15px;
color:#ffffff;
padding-top:10px;
padding-bottom:10px;
padding-left:30px;
padding-right:30px;
background-color:#005BBB;" class="btn btn-submit" name="enviar" type="submit"><i class="fa fa-sign-in"></i> Ingresar</button>
				</div>
			</div>
		</form>
	</center>