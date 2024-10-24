<?php
    session_start();
    require_once 'conexion.php'; // Incluye el archivo de conexión a la base de datos

    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['id_usuario'])) {
        echo "Sesión no encontrada. Redirigiendo a la página de inicio de sesión.";
        header('Location: index.php');
        exit;
    }

    // Verificar si el formulario fue enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_producto = $_POST['id_producto'] ?? '';
        $id_usuario = $_POST['id_usuario'] ?? '';
        $cantidad = $_POST['cantidad'] ?? '';

        // Validar los campos
        if (empty($id_producto) || empty($id_usuario) || empty($cantidad)) {
            echo "Todos los campos son obligatorios.";
            exit;
        }

        // Preparar la consulta SQL para insertar la venta
        $sql = "INSERT INTO ventas (id_producto, id_usuario, cantidad, fecha_venta) VALUES (?, ?, ?, NOW())";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('iii', $id_producto, $id_usuario, $cantidad); // 'i' para enteros

        if ($stmt->execute()) {
            echo "Venta registrada con éxito.";
            header('Location: dashboard.php');  // Redirigir de vuelta al dashboard después de registrar la venta
            exit;
        } else {
            echo "Error al registrar la venta: " . $conexion->error;
        }
    }
?>
