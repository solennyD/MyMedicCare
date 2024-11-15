<?php
session_start();

// Verificar si el usuario está autenticado
if(!isset($_SESSION["cedula_pasaporte"])) {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión si no está autenticado
    exit;
}

// Obtener la cédula o pasaporte del usuario autenticado
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

// Si se envió el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $contrasena = $_POST["contrasena"];
    $telefono = $_POST["telefono"];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE usuario SET nombre='$nombre', apellido='$apellido', correo='$correo', fecha_nacimiento='$fecha_nacimiento', contrasena='$contrasena', telefono='$telefono' WHERE cedula_pasaporte='$cedula_pasaporte'";

    if ($conn->query($sql) === TRUE) {
        echo "¡Perfil actualizado correctamente!";
    } else {
        echo "Error al actualizar el perfil: " . $conn->error;
    }
} else {
    // Obtener los datos del usuario de la base de datos
    $sql = "SELECT * FROM usuario WHERE cedula_pasaporte='$cedula_pasaporte'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row["nombre"];
        $apellido = $row["apellido"];
        $correo = $row["correo"];
        $fecha_nacimiento = $row["fecha_nacimiento"];
        $contrasena = $row["contrasena"];
        $telefono = $row["telefono"];
    } else {
        echo "No se encontró el usuario";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - MedicCare</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
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
            background-color: #f4f4f4;
        }
        .container {
            margin-top: 50px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
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
                    <li class="active"><a href="user.php" class="nav-btn"><i class='glyphicon glyphicon-start-alt'></i> Inicio <span class="sr-only">(current)</span></a></li>
                    <li><a href=""  class="nav-btn"> <i class='glyphicon glyphicon-user'></i> Mi Perfil</a></li>
                    

                    <li><a href="../web/login.php" class="nav-btn"><i class='glyphicon glyphicon-off'></i> Cerrar Sección</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1>Editar Perfil - MedicCare</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>">
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" value="<?php echo $contrasena; ?>">
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>">
            <input type="submit" value="Actualizar Perfil">
        </form>
    </div>

     <script src="../js/scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
