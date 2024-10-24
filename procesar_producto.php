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
        $nombre_producto = $_POST['nombre_producto'];
        $precio_producto = $_POST['precio_producto'];
        $id_categoria = $_POST['id_categoria'];

        // Limpiar las entradas para evitar inyecciones SQL
        $nombre_producto = $conexion->real_escape_string($nombre_producto);
        $precio_producto = $conexion->real_escape_string($precio_producto);
        $id_categoria = $conexion->real_escape_string($id_categoria);

        // Insertar el producto en la base de datos
        $sql = "INSERT INTO productos (nombre_producto, precio_producto, id_categoria) 
                VALUES ('$nombre_producto', '$precio_producto', '$id_categoria')";

        if ($conexion->query($sql) === TRUE) {
            echo "Producto registrado exitosamente.";
            header('Location: ingresar_producto.html'); // Redirigir al dashboard después de la inserción
            exit;
        } else {
            echo "Error al ingresar el producto: " . $conexion->error;
        }
    }
?>
