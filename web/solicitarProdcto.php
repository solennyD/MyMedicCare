<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["cedula_pasaporte"])) {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión si no está autenticado
    exit;
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombre_producto"]) && isset($_POST["descripcion"])) {
    // Obtener los datos del formulario
    $nombre_producto = $_POST["nombre_producto"];
    $descripcion = $_POST["descripcion"];
    
    // Conexión a la base de datos
    $servername = "mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com";
    $username = "admin";
    $password = "12345678";
    $dbname = "mediccare";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Insertar los nuevos productos en la tabla
    $sql = "INSERT INTO nuevos_productos (nombre_producto, descripcion) VALUES ('$nombre_producto', '$descripcion')";
    if ($conn->query($sql) === TRUE) {
        echo "<span style='color: blue;'>Solicitud de nuevos productos enviada correctamente. Estado: En revisión</span>";
    } else {
        echo "Error al enviar la solicitud de nuevos productos: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Nuevos Productos</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../img/imag.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="http://localhost/Medic Care/web/elegir_plan.php" class="nav-btn"><i class='glyphicon glyphicon-list-alt'></i> Plan <span class="sr-only">(current)</span></a></li>
                    <li><a href="modificarPerfil.php" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-user'></i> Mi Perfil</a></li>
                    <li><a href="polizas.php" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-user'></i> Mi poliza</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle nav-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='glyphicon glyphicon-list'></i> Consumos <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="medicamentos.php"><i class='glyphicon glyphicon-heart'></i> Medicamentos</a></li>
                            <li><a href="#"><i class='glyphicon glyphicon-ok-circle'></i> Pre-autorizaciones</a></li>
                            <li><a href="reembolso.html"><i class='glyphicon glyphicon-usd'></i> Reembolso</a></li>
                            <li><a href="#"><i class='glyphicon glyphicon-list-alt'></i> Consultas</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle nav-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='glyphicon glyphicon-edit'></i> Solicitudes <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="verdependiente.php"><i class='glyphicon glyphicon-user'></i> Dependientes</a></li>
                            <li><a href="reembolso.html"><i class='glyphicon glyphicon-usd'></i> Reembolso</a></li>
                            <li><a href="solicitarProdcto.php"><i class='glyphicon glyphicon-shopping-cart'></i> Nuevos Productos</a></li>
                        </ul>
                    </li>
                    <li><a href="../web/login.php" class="nav-btn"><i class='glyphicon glyphicon-off'></i> Cerrar Sección</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <form action="solicitar_productos.php" method="post">
            <h1>Solicitar Nuevos Productos</h1>
            <label for="nombre_producto">Nombre del Producto:</label><br>
            <input type="text" id="nombre_producto" name="nombre_producto" required><br><br>
            <label for="descripcion">Descripción:</label><br>
            <textarea id="descripcion" name="descripcion" rows="4" required></textarea><br><br>
            <input type="submit" value="Enviar Solicitud">
        </form>
    </div>
</body>
</html>
