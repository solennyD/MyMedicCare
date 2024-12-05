<?php
// Conexión a la base de datos
$conexion = new mysqli("mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com", "admin", "12345678", "mediccare");

// Verificar si hay errores de conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Query para obtener los datos de la tabla proveedoresmedicos
$sql = "SELECT ProveedorMedicoID, Nombre_Prov, Especialidad_Prov, Direccion_Prov, Telefono_Prov, Correo_Ele_Prov, Horario_Atencion_Prov FROM proveedoresmedicos";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Proveedores Médicos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Proveedores Médicos</h1>
        
        <!-- Botones para agregar y eliminar proveedores -->
        <div class="mb-3">
            <a href="agregar_proveedor.html" class="btn btn-primary">Agregar Proveedor</a>
            <a href="eliminar_proveedor.php" class="btn btn-danger">Eliminar Proveedor</a>
        </div>
        
        <!-- Tabla para mostrar los proveedores -->
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Especialidad</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Horario de Atención</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $fila['ProveedorMedicoID']; ?></td>
                        <td><?php echo $fila['Nombre_Prov']; ?></td>
                        <td><?php echo $fila['Especialidad_Prov']; ?></td>
                        <td><?php echo $fila['Direccion_Prov']; ?></td>
                        <td><?php echo $fila['Telefono_Prov']; ?></td>
                        <td><?php echo $fila['Correo_Ele_Prov']; ?></td>
                        <td><?php echo $fila['Horario_Atencion_Prov']; ?></td>
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
