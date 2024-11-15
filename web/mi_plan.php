<?php
session_start();

// Verificar si el usuario está autenticado
if(!isset($_SESSION["cedula_pasaporte"])) {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión si no está autenticado
    exit;
}

// Obtener la cédula del usuario autenticado
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
  $cedula_pasaporte = $_SESSION["usuario"];


// Consulta para obtener el plan del usuario
$sql_obtener_plan_usuario = "SELECT p.nombre AS nombre_plan, p.descripcion AS descripcion_plan, p.precio AS precio_plan FROM plan_usuario pu INNER JOIN plan p ON pu.plan_id = p.id WHERE pu.cedula_pasaporte = '$cedula_pasaporte'";
$result_obtener_plan_usuario = $conn->query($sql_obtener_plan_usuario);

// Verificar si el usuario tiene un plan registrado
if ($result_obtener_plan_usuario->num_rows > 0) {
    // Si tiene un plan registrado, mostrar la información del plan
    $row_plan = $result_obtener_plan_usuario->fetch_assoc();
    $nombre_plan = $row_plan["nombre_plan"];
    $descripcion_plan = $row_plan["descripcion_plan"];
    $precio_plan = $row_plan["precio_plan"];
} else {
    // Si no tiene un plan registrado, mostrar un mensaje para seleccionar un plan
    $mensaje_no_plan = "No posee aún ningún plan de seguro registrado.";
}

// Consulta para obtener la información de la farmacia
$sql_obtener_farmacia = "SELECT * FROM farmacia";
$result_obtener_farmacia = $conn->query($sql_obtener_farmacia);

// Consulta para obtener el historial médico del usuario
$sql_obtener_historial_medico = "SELECT * FROM historial_medico WHERE Asegurado_id = '$cedula_pasaporte'";
$result_obtener_historial_medico = $conn->query($sql_obtener_historial_medico);

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Plan - MedicCare</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        table {
            margin: auto;
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            margin-bottom: 20px;
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
                    <li><a href="user.php" class="nav-btn"><i class='glyphicon glyphicon-home'></i> Inicio <span class="sr-only">(current)</span></a></li>
                    <li><a href="modificarPerfil.php" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-user'></i> Mi Perfil</a></li>
                    <li><a href="Prestadores.php" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-user'></i> Prestadores</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle nav-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='glyphicon glyphicon-list'></i> Consumos <span class="caret"></span></a>
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
                    <li><a href="../web/login.php" class="nav-btn"><i class='glyphicon glyphicon-off'></i> Cerrar Sección</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <h1>Mi Plan - MedicCare</h1>
    
    <?php
    // Mostrar el plan del usuario si existe
    if (isset($nombre_plan)) {
        echo "<h2>Plan: " . $nombre_plan . "</h2>";
        echo "<p>" . $descripcion_plan . "</p>";
        echo "<h2>Precio: " . $precio_plan . "</p>";
    } elseif (isset($mensaje_no_plan)) {
        // Mostrar un mensaje si el usuario no tiene un plan registrado
        echo "<p>" . $mensaje_no_plan . "</p>";
        echo "<a href='seleccionar_plan.php'>Deseas agregar uno?</a>";
    }
    ?>

    <h2>Farmacias</h2>
    <table>
        <thead>
            <tr>
                <th>FarmaciaID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo Electrónico</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar información de la farmacia
            if ($result_obtener_farmacia->num_rows > 0) {
                while($row_farmacia = $result_obtener_farmacia->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_farmacia["FarmaciaID"] . "</td>";
                    echo "<td>" . $row_farmacia["Nombre_Farmacia"] . "</td>";
                    echo "<td>" . $row_farmacia["Direccion_Farm"] . "</td>";
                    echo "<td>" . $row_farmacia["Telefono_Farm"] . "</td>";
                    echo "<td>" . $row_farmacia["Correo_Ele_Farm"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se encontró información sobre farmacias.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Historial Médico</h2>
    <table>
        <thead>
            <tr>
                <th>HistorialMedicoID</th>
                <th>Asegurado ID</th>
                <th>Descripción Médica</th>
                <th>Fecha Consulta</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar historial médico del usuario
            if ($result_obtener_historial_medico->num_rows > 0) {
                while($row_historial = $result_obtener_historial_medico->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_historial["HistorialMedicoID"] . "</td>";
                    echo "<td>" . $row_historial["Asegurado_id"] . "</td>";
                    echo "<td>" . $row_historial["Descripcion_Medica"] . "</td>";
                    echo "<td>" . $row_historial["Fecha_Consulta"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontró historial médico.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
