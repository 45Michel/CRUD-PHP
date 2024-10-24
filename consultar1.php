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
    $sql_categorias = "SELECT ca.id_categoria, ca.nombre_categoria
                      FROM categorias ca ";

    $resultado_categorias = $conexion->query($sql_categorias);

    // Verificar si la consulta tiene registros
    if (!$resultado_categorias) {
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
        <h1>Consultar categorias</h1>

        <!-- Mostrar los productos -->
        <h2>categorias</h2>
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID Categoria</th>
                    <th>Nombre Categoria</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verificar si se encontraron registros
                if ($resultado_categorias->num_rows > 0) {
                    while ($categoria = $resultado_categorias->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $categoria['id_categoria'] . "</td>";
                        echo "<td>" . $categoria['nombre_categoria'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay categorias registradas</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Botón para regresar al Dashboard -->
        <button class="btn" onclick="window.location.href='dashboard.php';">Volver al Dashboard</button>
    </div>
</body>
</html>