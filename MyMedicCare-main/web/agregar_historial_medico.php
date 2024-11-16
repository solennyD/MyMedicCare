<?php
// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $asegurado_id = $_POST['asegurado_id'];
    $descripcion = $_POST['descripcion'];
    $fecha_consulta = $_POST['fecha_consulta'];
    
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "mediccare");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para agregar un nuevo registro de historial médico
    $sql = "INSERT INTO Historial_Medico (Asegurado_id, Descripcion_Medica, Fecha_Consulta) VALUES ('$asegurado_id', '$descripcion', '$fecha_consulta')";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        echo "Registro de historial médico agregado exitosamente.";
         header("Location: verHistorialMedico.php");
        exit();
    } else {
        echo "Error al agregar el registro de historial médico: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
