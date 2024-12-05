<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Cita</title>
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../img/imag.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
     <link rel="stylesheet" href="../css/bootstrap.css">

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
    <style>
        .container {
            margin: 50px auto;
            width: 80%;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Datos de la Cita</h2>
        <?php
        
        $servername = "mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com";
        $username = "admin";
        $password = "12345678";
        $dbname = "mediccare";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

       
        $cedula = $_GET['cedula'];

    
        $sql = "SELECT * FROM cita WHERE cedula = '$cedula'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
            echo "<table>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><th>Apellidos</th><td>".$row["apellidos"]."</td></tr>";
                echo "<tr><th>Cédula</th><td>".$row["cedula"]."</td></tr>";
                echo "<tr><th>Correo Electrónico</th><td>".$row["correo"]."</td></tr>";
                echo "<tr><th>Estatus</th><td>".$row["estatus"]."</td></tr>";
                echo "<tr><th>Fecha de Registro</th><td>".$row["fecha_registro"]."</td></tr>";
                echo "<tr><th>Nombres</th><td>".$row["nombres"]."</td></tr>";
                echo "<tr><th>Teléfono</th><td>".$row["telefono"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron registros para la cédula: $cedula";
        }

        
        $conn->close();
        ?>
        <p><a href="index.html">Volver al inicio</a></p>
    </div>
</body>
</html>
