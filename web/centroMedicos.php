<?php
// Conexión a la base de datos
$conexion = new mysqli("mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com", "admin", "12345678", "mediccare");

// Verificar si hay errores de conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Query para obtener los datos de la tabla centroatenmedi
$sql = "SELECT CentroAtencionMed, Nombre_Centro, Direccion_CentroAntencionMed, Telefono_CentroAtencionMed, Correo_Ele_CentroAtencionMed FROM centroatenmedi";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Centros de Atención Médica</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Centros de Atención Médica</h1>
        
        <!-- Botones para eliminar y agregar -->
        <div class="mb-3">
         
            <a href="insertar_centro.php" class="btn btn-primary">Agregar Centro</a>
        </div>
        
        <!-- Tabla para mostrar los datos -->
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
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
                        <td><?php echo $fila['Nombre_Centro']; ?></td>
                        <td><?php echo $fila['Direccion_CentroAntencionMed']; ?></td>
                        <td><?php echo $fila['Telefono_CentroAtencionMed']; ?></td>
                        <td><?php echo $fila['Correo_Ele_CentroAtencionMed']; ?></td>
                        <td>
                            <a href="eliminar_centro.php?id=<?php echo $fila['CentroAtencionMed']; ?>" onclick="return confirm('¿Estás seguro de eliminar este centro?')" class="btn btn-danger btn-sm">Eliminar</a>
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
