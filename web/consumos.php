<?php
session_start();
//evita que se el navegador me guarde cachet
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
//header("Expires: 0");  // Fecha en el pasado


if (!isset($_SESSION["usuario"])) {
   
    header("Location: login.php");
    exit(); 
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consumo de Seguro MedicCare</title>
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
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }
        h2 {
            color: #337ab7;
        }
        p {
            font-size: 16px;
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
                    <li class="active"><a href="./elegir_plan.php" class="nav-btn"><i class='glyphicon glyphicon-list-alt'></i> Plan <span class="sr-only">(current)</span></a></li>
                    <li><a href="modificarPerfil.php" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-user'></i> Mi Perfil</a></li>
                    

                        <li class="nav-btn"><a href="./consumos.php" class="nav-btn"><i class='glyphicon glyphicon-list'></i> Consumos <span class="sr-only">(current)</span></a></li>
                        <ul class="dropdown-menu">
                            <li><a href="medicamentos.php"><i class='glyphicon glyphicon-heart'></i> Medicamentos</a></li>
                            <li><a href="reembolso.html"><i class='glyphicon glyphicon-usd'></i> Reembolso</a></li>
                            <li><a href="#"><i class='glyphicon glyphicon-list-alt'></i> Consultas</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle nav-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='glyphicon glyphicon-edit'></i> Solicitudes <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="verdependiente.php"><i class='glyphicon glyphicon-user'></i> Dependientes</a></li>
                            <li><a href="reembolso.html"><i class='glyphicon glyphicon-usd'></i> Reembolso</a></li>
                            <li><a href="preautorizaciones.php"><i class='glyphicon glyphicon-usd'></i> Solicitar Preautorizaciones</a></li>
                            <li><a href="solicitarProdcto.php"><i class='glyphicon glyphicon-shopping-cart'></i> Nuevos Productos</a></li>
                        </ul>
                    </li>
                    <li>
                     <!-- Formulario que enviará una solicitud POST para cerrar sesión -->
                        <form action="logout.php" method="post" style="display: inline;">
                        <button type="submit" name="logout" class="nav-btn" style="background: #2889E4 ;  color: white; cursor: pointer; padding-top: 5% ; margin-top: 5% ;border: none">
                        <i class='glyphicon glyphicon-off'></i> Cerrar Sesión
                        </button>
                    </form>
                </li>

                </ul>
            </div>
        </div>
    </nav>

<body>
    <div class="container">
        <h2>Consumo de Seguro MedicCare</h2>
        
        <?php
        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "mediccare");

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Cédula o pasaporte del usuario
        $cedula_pasaporte = $_SESSION["usuario"];

        // Consulta SQL para obtener el consumo del usuario
        $sql_consumo = "SELECT SUM(monto_autorizado) AS total_consumo FROM consumo WHERE cedula_pasaporte = '$cedula_pasaporte'";
        $resultado_consumo = $conexion->query($sql_consumo);

        // Verificar si se encontraron resultados
        if ($resultado_consumo->num_rows > 0) {
            $row_consumo = $resultado_consumo->fetch_assoc();
            $total_consumo = $row_consumo["total_consumo"];
            
            // Consulta SQL para obtener la cobertura del plan del usuario
            $sql_cobertura = "SELECT coberturaPlan FROM plan_usuario WHERE cedula_pasaporte = '$cedula_pasaporte'";
            $resultado_cobertura = $conexion->query($sql_cobertura);
            
           
            if ($resultado_cobertura->num_rows > 0) {
                $row_cobertura = $resultado_cobertura->fetch_assoc();
                $cobertura_plan = $row_cobertura["coberturaPlan"];
                
                // Calcular el saldo disponible restando el consumo de la cobertura del plan
                $saldo_disponible = $cobertura_plan - $total_consumo;
                
               
                echo "<p>Señor/a  su consumo actual es de $" . number_format($total_consumo, 2) . ". Le queda un saldo disponible en su plan de $" . number_format($saldo_disponible, 2) . ".</p>";
            } else {
                echo "<p>No se encontraron datos de cobertura para este usuario.</p>";
            }
        } else {
            echo "<p>No se encontraron datos de consumo para este usuario.</p>";
        }

        // Cerrar la conexión
        $conexion->close();
        ?>
        
        <p>Póngase en contacto con nuestro servicio de atención al cliente si tiene alguna pregunta o necesita más información sobre su consumo.</p>
    </div>
</body>
</html>
