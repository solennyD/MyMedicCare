<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Medicamentos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Tabla de Medicamentos</h1>
    <table>
        <thead>
            <tr>
                <th>MedicamentoID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fabricante</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Fecha de Expiración</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mediccare";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta SQL para obtener los datos de la tabla de medicamentos
            $sql = "SELECT MedicamentoID, Nombre, Descripcion, Fabricante, Precio, Stock, FechaExpiracion FROM medicamentos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Mostrar datos de cada fila
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["MedicamentoID"] . "</td>";
                    echo "<td>" . $row["Nombre"] . "</td>";
                    echo "<td>" . $row["Descripcion"] . "</td>";
                    echo "<td>" . $row["Fabricante"] . "</td>";
                    echo "<td>" . $row["Precio"] . "</td>";
                    echo "<td>" . $row["Stock"] . "</td>";
                    echo "<td>" . $row["FechaExpiracion"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "0 resultados";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
