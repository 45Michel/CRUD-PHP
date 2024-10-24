<?php
	require_once 'conexion.php'; // Incluye el archivo de conexión a la base de datos
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	    // Recibir los valores del formulario
	    $nombre_usuario = $_POST['nombre_usuario'];
	    $email = $_POST['email'];
	    $clave_usuario = $_POST['clave_usuario'];

	    // Validar que el correo no exista previamente en la base de datos
	    $email = $conexion->real_escape_string($email);
	    $nombre_usuario = $conexion->real_escape_string($nombre_usuario);
	    $clave_usuario = $conexion->real_escape_string($clave_usuario);

	    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
	    $resultado = $conexion->query($sql);

	    if ($resultado->num_rows > 0) {
	        // El correo ya está registrado
	        echo "Este correo electrónico ya está registrado. Intenta con otro.";
	    } else {
	        // Encriptar la contraseña
	        $clave_encriptada = password_hash($clave_usuario, PASSWORD_BCRYPT);

	        // Insertar el nuevo usuario en la base de datos
	        $sql_insert = "INSERT INTO usuarios (nombre_usuario, email, clave_usuario, id_rol) 
	                       VALUES ('$nombre_usuario', '$email', '$clave_encriptada', 2)"; // 2: Cliente por defecto

	        if ($conexion->query($sql_insert) === TRUE) {
	            echo "Registro exitoso. Ahora puedes iniciar sesión.";
	            // Redirigir al login o dashboard si es necesario
	            header('Location: index.html');
	            exit;
	        } else {
	            echo "Error al registrar el usuario: " . $conexion->error;
	        }
	    }
	}
?>
