<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nosotros - Medic Care</title>
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
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="http://localhost/Medic Care/web/index.html" class="nav-btn"><i class='glyphicon glyphicon-list-alt'></i> Inicio <span class="sr-only">(current)</span></a></li>
                       <li class="dropdown">
                            <a href="#" class="dropdown-toggle nav-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='glyphicon glyphicon-barcode'></i> Servicios <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="planbasico.html">Plan Básico de Salud</a></li>
                                <li><a href="plancomplementario.html">Planes Complementarios</a></li>
                                <li><a href="plan_voluntarios.html">Planes Voluntarios</a></li>
                                
                            </ul>
                        </li>
                       
                        <li><a href="#" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-user'></i>  Contacto</a></li>
                        <li><a href="#" class="nav-btn"><i class='glyphicon glyphicon-envelope'></i> Soporte</a></li>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Nosotros</h3>
        </div>
       <div class="panel-body">
            <p>Medic Care es una empresa líder en la industria de la salud, comprometida con proporcionar servicios de atención médica de alta calidad a nuestros clientes. Nos esforzamos por mejorar la vida de las personas a través de soluciones innovadoras y accesibles.</p>
            <h4>Misión</h4>
            <p>Nuestra misión es proporcionar a nuestros clientes acceso fácil y conveniente a servicios de atención médica de calidad, enfocándonos en la prevención, el tratamiento y la promoción de la salud.</p>
            <h4>Visión</h4>
            <p>Nuestra visión es ser la opción preferida de servicios de salud para individuos y familias, ofreciendo soluciones integrales que promuevan una vida saludable y activa.</p>
            <p>Para más información sobre nuestros servicios y cómo podemos ayudarte, no dudes en contactarnos.</p>
        </div>
    </div>
</div>

<div>
    <p></p>
</div>

<div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <p class="navbar-text pull-left">&copy; Diseñado por grupo UASD 2024
            <a href="" target="_blank" style="color: #ecf0f1"> Systems S.A.C</a></p>
        </div>
    </div>

    <script src="../js/scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
