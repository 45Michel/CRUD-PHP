<?php
	$host = 'localhost';
	$usuario = 'Michel'; // Cambia a tu usuario de base de datos
	$password = '123'; // Cambia a tu contraseña de base de datos
	$db = 'evaluacion_programacion';

	$conexion = new mysqli($host, $usuario, $password, $db);

	if ($conexion->connect_error) {
	    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
	}
?>
