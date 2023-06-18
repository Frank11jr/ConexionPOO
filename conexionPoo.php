<?php
	
	include("config.php");
	include("conexionPhpMysql.php");
	
	$miconexion = new ConexionPhpMysql;
	$miconexion->conectar($servername, $username, $password, $database);

	// $sql = "insert into usuario values ('','Juan','Capa','jcapa@gmail.com','admin','89347290')";
	//$sql = "delete from usuario where id= 2";
	// $clave=md5('182636');
	// $sql="update usuario set clave='$clave' where id=4";

	$sql="select * from usuario";
	$res=$miconexion->consulta($sql);
	$miconexion->verconsulta();

	if ($res) {
		echo "<br>La sentencia se ha ejecutado correctamente";
	}else{
		echo "Hay un error de sql";
	}
?>