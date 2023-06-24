<?php
class conexionPhpMysql {
    // Varialbes de conexión
	var $BaseDatos;
	var $Servidor;
	var $Usuario;
	var $Clave;

	// Variables de control de errores
	var $Errno=0;
	var $Error="";

	// Identificacion de consultas y conexiones
	var $Conexion_ID=0;
	var $Consulta_ID=0;

	// Constructor 
	function conexionPhpMysql($host="", $user="", $pass="", $db=""){
		$this->BaseDatos=$db;
		$this->Servidor=$host;
		$this->Usuario=$user;
		$this->Clave=$pass;

	}

	// Función para conectarse a la Base de Datos
	function conectar($host, $user, $pass, $db){
		if ($db != "") $this->BaseDatos=$db;
		if ($host != "") $this->Servidor=$host;
		if ($user != "") $this->Usuario=$user;
		if ($pass != "") $this->Clave=$pass;

		$this->Conexion_ID = new mysqli($this->Servidor, $this->Usuario, $this->Clave, $this->BaseDatos);

		if (!$this->Conexion_ID) {
			$this->Error="Ha fallado la conexion";
			return 0;
		}
		return $this->Conexion_ID;
	}

	// Función para realizar consultas
	function consulta($sql=""){

		if ($sql=="") {
			$this->Error="No hay ninguna sentencia SQL";
			return 0;
		}

		$this->Consulta_ID= mysqli_query($this->Conexion_ID, $sql);
		if (!$this->Consulta_ID) {
			echo $this->Conexion_ID->error;
		}
		return $this->Consulta_ID;
	}

	// Retorna el numero de campos de la sonsulta
	function numcampos(){
		return mysqli_num_fields($this->Consulta_ID);
	}

	// Retorna el numero de registros de la consulta
	function numregistros(){
		return mysqli_num_rows($this->Consulta_ID);
	}

	// Observar la consulta en una tabla
	function verconsulta(){
		echo "<table border = 1 >";
		echo "<tr>";
		for ($i=0; $i < $this->numcampos(); $i++) { 
			echo "<td>".mysqli_fetch_field_direct($this->Consulta_ID, $i)->name."</td>";
		}
		echo "</tr>";
		while($row=mysqli_fetch_array($this->Consulta_ID)){
			echo "<tr>";
			for ($i=0; $i < $this->numcampos(); $i++) { 
				echo "<td>".$row[$i]."</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
}
?>