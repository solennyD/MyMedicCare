<?php
// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar el ID del registro de historial médico a eliminar
    $id_eliminar = $_POST['id_eliminar'];
    
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "mediccare");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para eliminar el registro de historial médico
    $sql = "DELETE FROM Historial_Medico WHERE HistorialMedicoID = $id_eliminar";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        echo "Registro de historial médico eliminado exitosamente.";
    } else {
        echo "Error al eliminar el registro de historial médico: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
