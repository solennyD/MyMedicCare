<?php
// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    
    // Conexión a la base de datos
    $conexion = new mysqli("mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com", "admin", "12345678", "mediccare");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para agregar una nueva clínica
    $sql = "INSERT INTO clinicas (Nombre_Cli, Direccion_Cli, Telefono_Cli, Correo_Ele_Cli) VALUES ('$nombre', '$direccion', '$telefono', '$correo')";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        echo "Clínica agregada exitosamente.";
         header("Location: ver_clinicas.php");
        exit(); 
    } else {
        echo "Error al agregar la clínica: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
