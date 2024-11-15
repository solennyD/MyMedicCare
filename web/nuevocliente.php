<!DOCTYPE html>
<html lang="en">
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
            color: black; 
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
        
    
        .logo-container {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            float: left; 
        }
        .logo {
            display: block;
            margin: auto; 
            max-width: 500%;
            height: 70%;
            margin-top: -20px;
        }
        .navbar-nav {
            margin-top: 10px;
            text-align: center;
            float: center;
        }
       
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

   <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><img src="http://localhost/Medic Care/img/logo.jpeg" alt="Logo Medic Care" class="logo"></h3>
        </div>
        <div class="panel-body">
            
     

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
                    <li class="active"><a href="./index.html" class="nav-btn"><i class='glyphicon glyphicon-list-alt'></i> Inicio <span class="sr-only">(current)</span></a></li>
                   <li class="dropdown">
                            <a href="#" class="dropdown-toggle nav-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='glyphicon glyphicon-barcode'></i> Servicios <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="planbasico.html">Plan Básico de Salud</a></li>
                                <li><a href="plancomplementario.html">Planes Complementarios</a></li>
                                <li><a href="plan_voluntarios.html">Planes Voluntarios</a></li>
                                
                            </ul>
                        </li>
                    <li><a href="nosotros.php" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-user'></i> Nosotros</a></li>

                    <li><a href="" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-user'></i>  Contacto</a></li>

                     <li><a href="" class="nav-btn"><i class='glyphicon glyphicon-envelope'></i> Soporte</a></li>
                     

                </ul>
       
            </div>
        </div>
    </nav>
   </div>
    </div>

    <div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Agendar Cita</h3>
        </div>
        <div class="panel-body">
            <div class="form-container">
    
               <form action="procesar_cita.php" method="post">
    <div class="form-group">
        <label for="apellidos">Apellidos:</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
    </div>
    <div class="form-group">
        <label for="cedula">Cédula:</label>
        <input type="text" class="form-control" id="cedula" name="cedula" required>
    </div>
    <div class="form-group">
        <label for="correo">Correo Electrónico:</label>
        <input type="email" class="form-control" id="correo" name="correo" required>
    </div>
    <div class="form-group">
        <label for="estatus">Estatus:</label>
        <div class="checkbox">
            <label><input type="checkbox" id="estatus" name="estatus" value="activo"> Activo</label>
        </div>
    </div>
    <div class="form-group">
        <label for="fecha">Fecha de Registro:</label>
        <input type="date" class="form-control" id="fecha" name="fecha" required>
    </div>
    <div class="form-group">
        <label for="nombres">Nombres:</label>
        <input type="text" class="form-control" id="nombres" name="nombres" required>
    </div>
    <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="text" class="form-control" id="telefono" name="telefono" required>
    </div>
    <button type="submit" class="btn btn-success">Agendar Cita</button>
</form>
            </div>
        </div>
    </div>
</div>
<p></p>
<p></p>
<div></div>
    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <p class="navbar-text pull-left">&copy; Diseñado por grupo  UASD 2024
                <a href="" target="_blank" style="color: #ecf0f1">Seguro Systems </a>
            </p>
        </div>
    </div>

    <script src="../js/scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
</body>

</html>
