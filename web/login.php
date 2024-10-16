<?php
//Inicio de session 
session_start();

// Manejo de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = new mysqli("localhost", "root", "", "mediccare");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

   
    if (isset($_POST["cedula_pasaporte"]) && isset($_POST["contrasena"])) {
        $cedula_pasaporte = $_POST["cedula_pasaporte"];
        $contrasena = $_POST["contrasena"];

        $consulta = $conexion->prepare("SELECT * FROM usuario WHERE cedula_pasaporte = ? LIMIT 1");
        $consulta->bind_param("s", $cedula_pasaporte);
        $consulta->execute();
        $resultado = $consulta->get_result();

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            if (password_verify($contrasena, $fila["contrasena"])) {
                $_SESSION["usuario"] = $fila["cedula_pasaporte"];
                header("Location: user.php");
                exit();
            }
        }

        $error = "Cédula o contraseña incorrectas.";
    }

    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">

    <title>Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../img/imag.png"/>
    <link rel="stylesheet" href="../css/bootstrap-responsive.css">
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
</head>

<body>

<header class="header">
      <!-- Header Inner -->
      <div class="header-inner">
        <div class="container">
          <div class="inner">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-12">
                <!-- Start Logo -->
                <div class="button">
                  <a href="index.html" class = "btn primary">INICIO</a>
                </div>
       
    <div id="login">
    <div id="login">
        <h2><span class="fontawesome-lock"></span>Iniciar Sesión</h2>
        <form action="login.php" method="POST"> 
            <fieldset>
                <h1><img src="../img/logo.jpeg" alt=""></h1>
                <p><label for="text">Cédula o Pasaporte</label></p>
                <p><input type="text" name="cedula_pasaporte" placeholder="" required autofocus/></p>
                <p><label for="password">Contraseña</label></p>
                <p><input type="password" name="contrasena" placeholder="*********" required></p>
                <p><input type="submit" class="btn btn-primary" value="Ingresar"></p>

                <!--<div class="button-container">
                    <input type="button" class="btn btn-primary" id="registerButton" value="Cambiar Rol">
                </div>-->
                <br>
                <div class="buttonAc">
                <a href="registro.php" class="btn primary">¿Aún no tienes una cuenta?</a> 
            </fieldset>
</header>
            <div class="error"><?php echo isset($error) ? $error : ""; ?></div>
        </form>
    </div>

    <script>
        document.getElementById("registerButton").addEventListener("click", function() {
            window.location.href = "loginadmin.php";
        });
    </script>

    <style>
        .button-container {
            text-align: center;
            margin-top: 10px; 
        }
    </style>
</body>
</html>
