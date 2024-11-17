<?php
// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre_hospital = $_POST['nombre_hospital'];
    $direccion_hospital = $_POST['direccion_hospital'];
    $telefono_hospital = $_POST['telefono_hospital'];
    $correo_hospital = $_POST['correo_hospital'];
    
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "usuario", "contraseña", "basededatos");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para agregar un nuevo hospital
    $sql = "INSERT INTO Hospitales (Nombre_Hos, Direccion_Hos, Telefono_Hos, Correo_Ele_Hos) VALUES ('$nombre_hospital', '$direccion_hospital', '$telefono_hospital', '$correo_hospital')";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        echo "Hospital agregado exitosamente.";
    } else {
        echo "Error al agregar el hospital: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
