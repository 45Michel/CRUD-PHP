<?php
session_start();  // Asegúrate de que la sesión se inicia correctamente
require_once 'conexion.php'; // Incluye el archivo de conexión a la base de datos

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';  // Captura el correo electrónico
    $password = $_POST['password'] ?? '';  // Captura la contraseña

    // Verifica si ambos campos están presentes
    if (empty($email) || empty($password)) {
        echo "Por favor, complete todos los campos.";
        exit;
    }

    // Consulta para verificar el usuario
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        // Verifica la contraseña
        if (password_verify($password, $usuario['clave_usuario'])) {
            // Iniciar sesión
            $_SESSION['id_usuario'] = $usuario['id_usuario'];  // Establece la sesión del usuario
            $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
            $_SESSION['id_rol'] = $usuario['id_rol'];

            // Redirigir al dashboard
            header('Location: dashboard.php');
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Correo electrónico no encontrado.";
    }
}
?>
