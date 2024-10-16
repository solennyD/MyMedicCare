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
        form {
            margin: 0 auto;
            width: 50%;
        }
        h2 {
            margin-bottom: 20px;
        }
        label, select, input[type="submit"] {
            display: block;
            margin: 10px auto;
        }
    </style>
</head>
<body>
    <h2>Eliminar Clínica</h2>
    <form action="eliminar_clinica.php" method="POST">
        <label for="id_clinica">Selecciona una clínica para eliminar:</label>
        <select name="id_clinica" id="id_clinica">
            <?php
            // Conexión a la base de datos
            $conexion = new mysqli("localhost", "root", "", "mediccare");

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Consulta SQL para obtener las clínicas existentes
            $sql = "SELECT ClinicaID, Nombre_Cli FROM Clinicas";
            $result = $conexion->query($sql);

            // Verificar si se encontraron clínicas
            if ($result->num_rows > 0) {
                // Mostrar cada clínica como opción en la lista desplegable
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['ClinicaID'] . "'>" . $row['Nombre_Cli'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay clínicas disponibles</option>";
            }

            // Cerrar la conexión
            $conexion->close();
            ?>
        </select>
        <input type="submit" value="Eliminar Clínica">
    </form>
</body>
</html>
