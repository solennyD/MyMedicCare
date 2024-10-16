<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["cedula_pasaporte"])) {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión si no está autenticado
    exit;
}

// Obtener la cédula del usuario autenticado
$cedula_pasaporte = $_SESSION["cedula_pasaporte"];

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mediccare";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener las solicitudes de reembolso del usuario actual
$sql = "SELECT * FROM solicitud_reembolso WHERE cedula_pasaporte = '$cedula_pasaporte'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de Reembolso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        table {
            margin: auto;
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Solicitudes de Reembolso</h1>
    <?php
    if ($result->num_rows > 0) {
        // Mostrar la tabla de solicitudes de reembolso
        echo "<table>";
        echo "<tr><th>ID</th><th>Cédula</th><th>Fecha</th><th>Monto</th><th>Estado</th><th>Descripción</th><th>Archivo Adjunto</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["cedula_pasaporte"] . "</td>";
            echo "<td>" . $row["fecha_solicitud"] . "</td>";
            echo "<td>" . $row["monto"] . "</td>";
            echo "<td>" . $row["estado"] . "</td>";
            echo "<td>" . $row["descripcion"] . "</td>";
            echo "<td><a href='" . $row["archivo_adjunto"] . "' target='_blank'>Ver Archivo</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron solicitudes de reembolso.";
    }
    ?>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
