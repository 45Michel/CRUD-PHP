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
    $sql_ventas = "SELECT v.id_venta, usu.id_usuario, pr.id_producto, v.cantidad, v.fecha_venta 
                      FROM ventas v
                      JOIN usuarios usu ON v.id_usuario = usu.id_usuario
                      JOIN productos pr ON v.id_producto = pr.id_producto";

    $resultado_venta = $conexion->query($sql_ventas);

    // Verificar si la consulta tiene registros
    if (!$resultado_venta) {
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
        <h1>Consultar Ventas</h1>

        <!-- Mostrar los productos -->
        <h2>Ventas</h2>
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID ventass</th>
                    <th>ID usuarios</th>
                    <th>ID productos</th>
                    <th>cantidad</th>
                    <th>fecha venta</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verificar si se encontraron registros
                if ($resultado_venta->num_rows > 0) {
                    while ($venta = $resultado_venta->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $venta['id_venta'] . "</td>";
                        echo "<td>" . $venta['id_usuario'] . "</td>";
                        echo "<td>" . $venta['id_producto'] . "</td>";
                        echo "<td>" . $venta['cantidad'] . "</td>";
                        echo "<td>" . $venta['fecha_venta'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay ventas registrados</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Botón para regresar al Dashboard -->
        <button class="btn" onclick="window.location.href='dashboard.php';">Volver al Dashboard</button>
    </div>
</body>
</html>