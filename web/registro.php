<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>*** Seguro Medic Care ***</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../img/imag.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
    <style>
         body {
            background-color: #f8f8f8;
        }
        .panel-primary {
            border-color: #337ab7;
            text-align: center;
        }
        .panel-primary > .panel-heading {
            color: #fff;
            background-color: white;
            border-color: #337ab7;
            text-align: center;
        }
        .panel-title {
            font-size: 24px;
        }
        .welcome-message {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
            color: black; /* Color azul */
        }
        .concentrix-logo {
            max-width: 100%;
            height: auto;
        }
        .navbar-brand {
            font-size: 28px;
            text-align: center;
            width: 100%;
            margin: 15px 0;
        }
        .nav-btn {
            font-size: 18px;
        }
        .nav-btn i {
            margin-right: 10px;
        }
        .navbar-right {
            margin-right: 20px;
        }
        .navbar-text {
            font-size: 16px;
        }
        .panel-title {
            font-size: 24px;
            text-align: center;
        }
        .servicio {
            margin-bottom: 20px;
        }
        .servicio img {
            width: 100%;
            height: auto;
        }
        .servicio .mas-informacion {
            margin-top: 10px;
        }
       
        
        /* Estilo para el logo */
        .logo-container {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            float: left; /* Para alineación a la izquierda */
        }
        .logo {
            display: block;
            margin: auto; /* Para centrar horizontalmente */
            max-width: 500%;
            height: 70%;
            margin-top: -20px;
        /* Estilo para alinear la barra de navegación */
        }
        .navbar-nav {
            margin-top: 10px;
            text-align: center;
            float: center;
        }
        /* Estilo para los cuadros de servicios */
        .servicio {
            text-align: center;
        }
        .servicio img {
            max-width: 100%;
            height: auto;
        }
        .servicio .mas-informacion {
            margin-top: 10px;
        }

    </style>
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
                 <br>
                 <div class="button">
                  <a href="index.html" class = "btn primary">INICIO</a>
                </div>

<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Afiliate</h3>
        </div>
       <div class="panel-body">
    <div class="form-container">
        <form action="procesar_registro.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="form-group">
                <label for="cedula_pasaporte">Cédula o Pasaporte:</label>
                <input type="text" class="form-control" id="cedula_pasaporte" name="cedula_pasaporte" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono/Celular:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="form-group">
    <label for="contrasena">Contraseña:</label>
    <input type="password" placeholder="*********" class="form-control" id="contrasena" name="contrasena" required>
</div>
<div class="form-group">
    <label for="confirmar_contrasena">Confirmar Contraseña:</label>
    <input type="password" placeholder="*********" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" required>
</div>

            <button type="submit" class="btn btn-success">Regístrate</button>
        </form>
        <p>¿Ya eres usuario de Más Futuro? <a href="login.php">Acceder</a></p>
    </div>
</div>
</header>


<div class="navbar navbar-default navbar-fixed-bottom">
    <!-- Tu pie de página aquí -->
</div>

<script src="../js/scripts.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>