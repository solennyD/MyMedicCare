<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
    // Si el usuario no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: login.php");
    exit();
}

// Verificar si se ha enviado el formulario de aprobación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_solicitud"])) {
    // Obtener el ID de la solicitud a aprobar
    $id_solicitud = $_POST["id_solicitud"];

    // Establecer conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "mediccare");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para actualizar el estado de la solicitud y sumar el monto aprobado a la tabla monto
    $sql = "UPDATE preautorizaciones SET estado = 'Aprobado' WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_solicitud);

    if ($stmt->execute()) {
        echo "La solicitud ha sido aprobada correctamente.";
    } else {
        echo "Error al aprobar la solicitud: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}

// Consulta SQL para obtener todas las preautorizaciones
$conexion = new mysqli("localhost", "root", "", "mediccare");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT * FROM preautorizaciones";
$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Preautorizaciones</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
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
        form {
            display: inline;
        }
        .aprobar-btn {
            background-color: #4CAF50;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .aprobar-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Visualizar Preautorizaciones</h1>
    </header>
   
    <main>
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
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $fila['id']; ?></td>
                    <td><?php echo $fila['cedula_pasaporte']; ?></td>
                    <td><?php echo $fila['prestador']; ?></td>
                    <td><?php echo $fila['monto_solicitado']; ?></td>
                    <td><?php echo $fila['fecha_solicitud']; ?></td>
                    <td><?php echo $fila['estado']; ?></td>
                    <td><?php echo $fila['tipo']; ?></td>
                    <td>
                        <?php if ($fila['estado'] !== 'Aprobado'): ?>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="id_solicitud" value="<?php echo $fila['id']; ?>">
                                <button type="submit" class="aprobar-btn">Aprobar</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos y liberar recursos
$conexion->close();
?>
