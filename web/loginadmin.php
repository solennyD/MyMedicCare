<?php
session_start();

// Manejo de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $conexion = new mysqli("mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com", "admin", "12345678", "mediccare");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Verificar si los datos del formulario han sido enviados
    if (isset($_POST["cedula_pasaporte"]) && isset($_POST["contrasena"])) {
        $cedula_pasaporte = $_POST["cedula_pasaporte"];
        $contrasena = $_POST["contrasena"];

        $consulta = $conexion->prepare("SELECT * FROM administrador WHERE Cedula = ? LIMIT 1");
        $consulta->bind_param("s", $cedula_pasaporte);
        $consulta->execute();
        $resultado = $consulta->get_result();

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            if (password_verify($contrasena, $fila["Contrasena"])) {
                // Establecer los datos del usuario como un array en la sesión
                $_SESSION["usuario"] = [
                    "rol" => "admin",
                    // Otros datos del usuario si los hay
                ];
                header("Location: pagina_de_administrador.php");
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
    <title>Iniciar Sesión Administrador</title>
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
<div>
    <a href="index.html" class="btn primary" style="display: inline-block; color: black; padding: 5px 20px; text-decoration: none; font-size: 16px; font-family: Arial, sans-serif; border-radius: 5px; border: 2px solid #007BB5; text-align: center; ">
        INICIO
    </a>
</div>
    
<header class="header">
      <!-- Header Inner -->
      <div class="header-inner">
        <div class="container">
          <div class="inner">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-12">
                <!-- Start Logo -->
                

    <div id="login">
        <h2><span class="fontawesome-lock"></span>Sesión Administrador</h2>
        <form action="login_administrador.php" method="POST"> 
            <fieldset>
                <h1><img src="../img/logo2.png" alt="" style="width: 80%;"></h1>
                <p><label for="text">Cédula</label></p>
                <p><input type="text" name="cedula_pasaporte" placeholder="" required autofocus/></p>
                <p><label for="password">Contraseña</label></p>
                <p><input type="password" name="contrasena" placeholder="*********" required></p>
                <p><input type="submit" class="btn btn-primary" value="Ingresar"></p>

                <!--<div class="button-container">
                    <input type="button" class="btn btn-primary" id="registerButton" value="Cambiar Rol">
                </div>-->
            
            </fieldset>
            <div class="error"><?php echo isset($error) ? $error : ""; ?></div>
        </form>
    </div>

</header>
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

