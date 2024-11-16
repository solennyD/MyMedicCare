<?php
// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar el ID del hospital a eliminar
    $id_hospital_eliminar = $_POST['id_hospital_eliminar'];
    
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "medccare");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para eliminar el hospital
    $sql = "DELETE FROM Hospitales WHERE HospitalID = $id_hospital_eliminar";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        echo "Hospital eliminado exitosamente.";
    } else {
        echo "Error al eliminar el hospital: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
