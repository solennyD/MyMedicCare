<?php
//Inicio de session 
session_start();

// Manejo de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = new mysqli("mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com", "admin", "12345678", "mediccare");

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
 <!--   <link rel="stylesheet" href="../css/bootstrap-responsive.css">
   <link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
   <link rel="stylesheet" href="../css/bootstrap.css">
   <link rel="stylesheet" href="../css/style.css"> -->
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">

    <style>
        body{
            background-image:url(https://img.freepik.com/vector-premium/fondo-abstracto-azul-salud_66029-25.jpg?semt=ais_hybrid);
            background-size: cover;
            padding: 5%;
        }
    #login {
        background-color: rgba(176, 224, 230, 0.2); /* Azul transparente */
        border: 2px solid #007BB5; /* Bordes rojo clarito */
        padding: 20px;
        border-radius: 10px;
        max-width: 400px;
        margin: auto;
        text-align: center; /* Centra el contenido dentro del div */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    #login h1 {
        color: #007BB5; /* Azul oscuro para el texto */
    }

    #login h1 img {
        display: block;
        margin: 0 auto; /* Centra la imagen del logo */
        max-width: 200px;
        height: auto;
    }

    #login input[type="text"],
    #login input[type="password"],
    #login input[type="submit"] {
        width: calc(100% - 20px);
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #FF9999; /* Bordes rojo clarito */
        border-radius: 5px;
    }

    #login input[type="submit"] {
        background-color: #4FC3F7; /* Azul claro vibrante */
        color: white;
        cursor: pointer;
        border: none;
    }

    #login input[type="submit"]:hover {
        background-color: #007BB5; /* Azul más oscuro al pasar el mouse */
    }

    .buttonAc a {
        color: #007BB5;
        text-decoration: none;
    }

    .buttonAc a:hover {
        text-decoration: underline;
    }
</style>


</head>

<body>
<div>
    <a href="index.html" class="btn primary" style="display: inline-block; background-color: #4FC3F7; color: white; padding: 5px 20px; text-decoration: none; font-size: 16px; font-family: Arial, sans-serif; border-radius: 5px; border: 2px solid #007BB5; text-align: center; cursor: pointer; transition: background-color 0.3s ease, transform 0.2s ease;">
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
        <h1><span class="fontawesome-lock"></span>Iniciar Sesión</h1>
        <form action="login.php" method="POST"> 
            
                <h1><img src="../img/logo2.png" alt="" style="width:80%"></h1>
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
