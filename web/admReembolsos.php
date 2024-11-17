<?php
session_start();

// Verificar si el usuario está autenticado como administrador
if(!isset($_SESSION["admin"])) {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión si no está autenticado como administrador
    exit;
}

// Consultar las solicitudes de reembolso
$sql = "SELECT * FROM solicitud_reembolso";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar las solicitudes de reembolso
    while($row = $result->fetch_assoc()) {
        echo "Solicitud de Reembolso #" . $row["id"] . "<br>";
        echo "Cédula: " . $row["cedula_pasaporte"] . "<br>";
        echo "Monto: " . $row["monto"] . "<br>";
        echo "Descripción: " . $row["descripcion"] . "<br>";
        echo "<a href='" . $row["archivo_adjunto"] . "' target='_blank'>Ver Documento Adjunto</a><br><br>";
    }
} else {
    echo "No hay solicitudes de reembolso.";
}
?>
