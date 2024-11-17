<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "usuario", "contraseña", "basededatos");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para seleccionar todos los registros de la tabla Clinicas
$sql = "SELECT * FROM Clinicas";

// Ejecutar la consulta
$resultado = $conexion->query($sql);

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Crear una tabla HTML para mostrar los datos
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Dirección</th><th>Teléfono</th><th>Correo Electrónico</th></tr>";
    
    // Mostrar los datos en la tabla
    while($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila["ClinicaID"] . "</td>";
        echo "<td>" . $fila["Nombre_Cli"] . "</td>";
        echo "<td>" . $fila["Direccion_Cli"] . "</td>";
        echo "<td>" . $fila["Telefono_Cli"] . "</td>";
        echo "<td>" . $fila["Correo_Ele_Cli"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron registros en la tabla Clinicas";
}

// Cerrar la conexión
$conexion->close();
?>
