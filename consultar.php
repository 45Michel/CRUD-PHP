<?php
    session_start();  // Asegúrate de que la sesión esté iniciada
    require_once 'conexion.php'; // Incluye el archivo de conexión a la base de datos

    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['id_usuario'])) {
        echo "Sesión no encontrada. Redirigiendo a la página de inicio de sesión.";
        header('Location: index.php');  // Redirigir a la página de inicio de sesión
        exit;
    }

    // Consultar registros de productos y sus categorías
    $sql_productos = "SELECT p.id_producto, p.nombre_producto, p.precio_producto, c.nombre_categoria 
                      FROM productos p 
                      JOIN categorias c ON p.id_categoria = c.id_categoria";

    $resultado_productos = $conexion->query($sql_productos);

    // Verificar si la consulta tiene registros
    if (!$resultado_productos) {
        die("Error en la consulta: " . $conexion->error);
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Registros</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Consultar Productos</h1>

        <!-- Mostrar los productos -->
        <h2>Productos</h2>
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID Producto</th>
                    <th>Nombre del Producto</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verificar si se encontraron registros
                if ($resultado_productos->num_rows > 0) {
                    while ($producto = $resultado_productos->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $producto['id_producto'] . "</td>";
                        echo "<td>" . $producto['nombre_producto'] . "</td>";
                        echo "<td>" . $producto['precio_producto'] . "</td>";
                        echo "<td>" . $producto['nombre_categoria'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay productos registrados</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Botón para regresar al Dashboard -->
        <button class="btn" onclick="window.location.href='dashboard.php';">Volver al Dashboard</button>
    </div>
</body>
</html>