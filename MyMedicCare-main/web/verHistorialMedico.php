<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Historial Médico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h2 {
            margin-top: 50px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Ver Historial Médico</h2>

    <table>
        <thead>
            <tr>
                <th>ID del Asegurado</th>
                <th>Descripción Médica</th>
                <th>Fecha de Consulta</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Conexión a la base de datos
            $conexion = new mysqli("localhost", "root", "", "mediccare");

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Consulta SQL para obtener el historial médico
            $sql = "SELECT Asegurado_id, Descripcion_Medica, Fecha_Consulta FROM Historial_Medico";
            $result = $conexion->query($sql);

            // Mostrar los resultados en la tabla
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["Asegurado_id"] . "</td>";
                    echo "<td>" . $row["Descripcion_Medica"] . "</td>";
                    echo "<td>" . $row["Fecha_Consulta"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No se encontraron registros en el historial médico.</td></tr>";
            }

            // Cerrar la conexión
            $conexion->close();
            ?>
        </tbody>
    </table>
</body>
</html>
