<?php
// Conexión a la base de datos del archivo registro

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mediccare";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Insertar datos de ejemplo en la tabla plan
$sql = "INSERT INTO plan (nombre, descripcion, precio, duracion_meses) VALUES
        ('Plan Básico', 'Cobertura básica para cuidado de la salud.', 50.00, 12),
        ('Plan Estándar', 'Cobertura estándar para cuidado de la salud.', 80.00, 12),
        ('Plan Premium', 'Cobertura premium para cuidado de la salud.', 120.00, 12)";

if ($conn->query($sql) === TRUE) {
    echo "Los planes se han creado correctamente.";
} else {
    echo "Error al crear los planes: " . $conn->error;
}

$conn->close();
?>
