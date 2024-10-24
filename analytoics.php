<?php
session_start();  // Inicia la sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    // Si no hay sesión iniciada, redirigir a la página de inicio de sesión
    echo "Sesión no encontrada. Redirigiendo a la página de inicio de sesión.";
    header('Location: index.php');
    exit;
}

// Obtener el nombre del usuario y el rol desde la sesión
$nombre_usuario = $_SESSION['nombre_usuario'];
$id_rol = $_SESSION['id_rol'];

// Aquí puedes realizar consultas o mostrar contenido específico según el rol del usuario
$rol = ($id_rol == 1) ? 'Administrador' : 'Cliente';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenido al Panel de Control</h1>
        <p>Hola, <strong><?php echo $nombre_usuario; ?></strong>. Estás conectado como <strong><?php echo $rol; ?></strong>.</p>

        <!-- Opciones del dashboard -->
        <nav>
            <ul>
                <li><a href="ingresar_producto.html">Ingresar Producto</a></li>
                <li><a href="ingresar_categoria.html">Ingresar Categoría</a></li>
                <li><a href="ingresar_ventas.php">Ingresar Ventas</a></li>
                <hr>
                <li><a href="consultar.php">Consultar Productos</a></li>
                <li><a href="consultar1.php">Consultar Categórías</a></li>
                <li><a href="consultar2.php">Consultar Ventas</a></li>
                <hr>
                <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
