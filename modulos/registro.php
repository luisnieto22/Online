<?php
if(isset($_SESSION['id_cliente'])){
	redir("./");
}

if(isset($enviar)){
	$usuario_nombre= clear($usuario_nombre);
	$password = clear($password);
	$cpassword = clear($cpassword);
	$nombre = clear($nombre);

	$password_encript = sha1(md5($password));

	$pdo = conpdo();

	$check = $pdo->prepare("SELECT * FROM clientes WHERE usuario_nombre = :email");
	$check->bindParam("email",$usuario_nombre,PDO::PARAM_STR);
	$check->execute();
	$resultcheck = $check->rowCount();

	if($resultcheck>0){
		alert("El usuario ya existe en la plataforma",0,"registro");
		die();
	}



	/*
	$q = $mysqli->query("SELECT * FROM clientes WHERE usuario_nombre= '$usuario_nombre'");
	if(mysqli_num_rows($q)>0){
		alert("El usuario ya existe en la plataforma ",0,'registro');
		die();
	}
	*/
	if($password != $cpassword){
		
		alert("Las contraseñas no coinciden",0,'registro');
		die();
	}

	$query = $pdo->prepare("INSERT INTO clientes (usuario_nombre,password,name) VALUES (:usuario_nombre,:password,:nombre)");
	$query->bindParam("usuario_nombre",$usuario_nombre,PDO::PARAM_STR);
	$query->bindParam("password",$password_encript,PDO::PARAM_STR);
	$query->bindParam("nombre",$nombre,PDO::PARAM_STR);
	$query->execute();


	$queryconnect = $pdo->prepare("SELECT * FROM clientes WHERE usuario_nombre = :usuario_nombre ORDER BY id DESC LIMIT 1");
	$queryconnect->bindParam("usuario_nombre",$usuario_nombre,PDO::PARAM_STR);
	$queryconnect->execute();
	$r = $queryconnect->fetch(PDO::FETCH_ASSOC);	
		
	/*$mysqli->query("INSERT INTO clientes (usuario_nombre,password,name) VALUES ('$usuario_nombre','$password','$nombre')");
	$q2 = $mysqli->query("SELECT * FROM clientes WHERE usuario_nombre= '$usuario_nombre'");
	$r = mysqli_fetch_array($q2);*/
	$_SESSION['id_cliente'] = $r['id'];
	alert("Te has registrado satisfactoriamente",1,'principal');
	die();
	//redir("./");
}
	?>


	<center>
		<form method="post" action="">
			<div class="centrar-login">
				<label><h2><i class="fa fa-key"></i> Registrate</h2></label>
				<div class="form-group">
					<input type="email" autocomplete="off" class="form-control" placeholder="Correo Electroncio" required name="usuario_nombre" >
				</div>

				<div class="form-group">
					<input type="password" class="form-control" placeholder="Contraseña" required name="password" />
				</div>

				<div class="form-group">
					<input type="password" class="form-control" placeholder="Confirmar Contraseña" required name="cpassword" >
				</div>


				<div class="form-group">
					<input type="text" autocomplete="off" class="form-control" placeholder="Nombre completo del usuario" required name="nombre" >
				</div>

				<div class="form-group">
					<button style="text-decoration:none;
font-weight:600;
font-size:15px;
color:#ffffff;
padding-top:10px;
padding-bottom:10px;
padding-left:30px;
padding-right:30px;
background-color:#005BBB;" class="btn btn-submit" name="enviar" type="submit"><i class="fa fa-sign-in"></i> Registrate</button>
				</div>
			</div>
		</form>
	</center>



	