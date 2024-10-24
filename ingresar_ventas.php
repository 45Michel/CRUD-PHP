<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Venta</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Ingresar Venta</h1>

        <form action="procesar_venta.php" method="POST">
            <!-- Desplegable para seleccionar un producto -->
            <label for="id_producto">Producto:</label>
            <select id="id_producto" name="id_producto" required>
                <option value="">Seleccione un producto</option>
                <?php
                // Conexión a la base de datos
                require_once 'conexion.php';

                // Obtener los productos
                $sql_productos = "SELECT id_producto, nombre_producto FROM productos";
                $resultado_productos = $conexion->query($sql_productos);

                if ($resultado_productos->num_rows > 0) {
                    while ($producto = $resultado_productos->fetch_assoc()) {
                        echo "<option value='" . $producto['id_producto'] . "'>" . $producto['nombre_producto'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay productos disponibles</option>";
                }
                ?>
            </select>

            <!-- Desplegable para seleccionar un usuario -->
            <label for="id_usuario">Usuario:</label>
            <select id="id_usuario" name="id_usuario" required>
                <option value="">Seleccione un usuario</option>
                <?php
                // Obtener los usuarios
                $sql_usuarios = "SELECT id_usuario, nombre_usuario FROM usuarios";
                $resultado_usuarios = $conexion->query($sql_usuarios);

                if ($resultado_usuarios->num_rows > 0) {
                    while ($usuario = $resultado_usuarios->fetch_assoc()) {
                        echo "<option value='" . $usuario['id_usuario'] . "'>" . $usuario['nombre_usuario'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay usuarios disponibles</option>";
                }
                ?>
            </select>

            <!-- Campo para ingresar la cantidad -->
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" required>

            <!-- Botón para registrar la venta -->
            <button type="submit">Registrar Venta</button>
        </form>

        <button class="btn" onclick="window.location.href='dashboard.php';">Volver al Dashboard</button>
    </div>
</body>
</html>
