<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Clínica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .success-bar {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin-top: 20px;
        }
        .error-bar {
            background-color: #f44336;
            color: white;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php
    // Verificar si se recibió el ID de la clínica a eliminar
    if (isset($_POST['id_clinica'])) {
        // Recuperar el ID de la clínica
        $id_clinica = $_POST['id_clinica'];

        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "mediccare");

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Consulta SQL para eliminar la clínica
        $sql = "DELETE FROM Clinicas WHERE ClinicaID = $id_clinica";

        // Ejecutar la consulta
        if ($conexion->query($sql) === TRUE) {
            echo '<div class="success-bar">Clínica eliminada exitosamente.</div>';
        } else {
            echo '<div class="error-bar">Error al eliminar la clínica: ' . $conexion->error . '</div>';
        }

        // Cerrar la conexión
        $conexion->close();
    } else {
        // Si no se recibió el ID de la clínica, mostrar un mensaje de error
        echo '<div class="error-bar">No se recibió el ID de la clínica.</div>';
    }
    ?>

    <!-- Redirigir a verclinicas.php después de 2 segundos -->
    <script>
        setTimeout(function() {
            window.location.href = 'ver_clinicas.php';
        }, 2000); // 2000 milisegundos = 2 segundos
    </script>
</body>
</html>
