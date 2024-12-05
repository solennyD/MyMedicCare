<?php
// Conexión a la base de datos
$conexion = new mysqli("mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com", "admin", "12345678", "mediccare");

// Verificar si hay errores de conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Query para obtener los datos de la tabla prestador
$sql = "SELECT id, nombre_prestador, direccion, telefono, email FROM prestador";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Prestadores</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos CSS */
        .container {
            margin-top: 50px;
        }
        .btn-margin {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Prestadores</h1>
        
        <!-- Botones para eliminar y agregar -->
        <div class="mb-3">
            
            <a href="agregar_prestador.html" class="btn btn-primary">Agregar Prestador</a>
        </div>
        
        <!-- Tabla para mostrar los datos -->
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $fila['id']; ?></td>
                        <td><?php echo $fila['nombre_prestador']; ?></td>
                        <td><?php echo $fila['direccion']; ?></td>
                        <td><?php echo $fila['telefono']; ?></td>
                        <td><?php echo $fila['email']; ?></td>
                        <td>
                            <a href="eliminar_prestador.php?id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este prestador?')" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
// Cerrar conexión y liberar recursos
$resultado->close();
$conexion->close();
?>
