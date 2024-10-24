<?php
    session_start();
    require_once 'conexion.php'; // Conexión a la base de datos

    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: index.html');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recibir los valores del formulario
        $nombre_categoria = $_POST['nombre_categoria'];
        // Limpiar las entradas para evitar inyecciones SQL
        $nombre_categoria = $conexion->real_escape_string($nombre_categoria);

        // Insertar el producto en la base de datos
        $sql = "INSERT INTO categorias (nombre_categoria) 
                VALUES ('$nombre_categoria')";

        if ($conexion->query($sql) === TRUE) {
            echo "Producto registrado exitosamente.";
            header('Location: ingresar_categoria.html'); // Redirigir al dashboard después de la inserción
            exit;
        } else {
            echo "Error al ingresar el producto: " . $conexion->error;
        }
    }
?>