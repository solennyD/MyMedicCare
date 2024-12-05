<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
    // Si el usuario no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: login.php");
    exit();
}

// Obtener la cédula del usuario desde la sesión
$cedula_usuario = $_SESSION["usuario"];

// Establecer conexión a la base de datos
$conexion = new mysqli("mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com", "admin", "12345678", "mediccare");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para obtener las solicitudes de preautorización asociadas al usuario actual
$sql = "SELECT * FROM preautorizaciones WHERE cedula_pasaporte = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $cedula_usuario);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Solicitudes de Preautorización</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: blue;
            color: white;
            text-align: center;
            padding: 1rem 0;
        }
        main {
            padding: 20px;
            margin: 20px;
        }
        h1, h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header>
        <h1>Visualizar Solicitudes de Preautorización</h1>
    </header>
   
    <main>
        <h2>Solicitudes de Preautorización para <?php echo $cedula_usuario; ?></h2>
        
        <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cédula o Pasaporte</th>
                    <th>Prestador</th>
                    <th>Monto Solicitado</th>
                    <th>Fecha de Solicitud</th>
                    <th>Estado</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $fila['id']; ?></td>
                    <td><?php echo $fila['cedula_pasaporte']; ?></td>
                    <td><?php echo $fila['prestador']; ?></td>
                    <td>$<?php echo number_format($fila['monto_solicitado'], 2); ?></td>
                    <td><?php echo $fila['fecha_solicitud']; ?></td>
                    <td><?php echo $fila['estado']; ?></td>
                    <td><?php echo $fila['tipo']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No hay solicitudes de preautorización para este usuario.</p>
        <?php endif; ?>

    </main>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos y liberar recursos
$stmt->close();
$conexion->close();
?>
