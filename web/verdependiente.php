<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["usuario"])) {
    // Si no está autenticado, redirigir al usuario al inicio de sesión
    header("Location: login.php");
    exit(); // Detener la ejecución del script después de redirigir
}

// Obtener la cédula del usuario desde la sesión
$cedula_usuario = $_SESSION["usuario"];

// Establecer conexión a la base de datos
$servername = "mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "12345678";
$dbname = "mediccare";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para recuperar los dependientes asociados al titular actual
$sql = "SELECT * FROM Dependiente WHERE cedula_pasaporte = ?";
// Preparar la consulta
$stmt = $conn->prepare($sql);
// Vincular parámetros
$stmt->bind_param("s", $cedula_usuario);
// Ejecutar la consulta
$stmt->execute();
// Obtener resultados
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dependientes</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
    <style>
        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
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
                    <li class="active"><a href="./pagina_de_administrador.php" class="nav-btn"><i class='glyphicon glyphicon-list-alt'></i> Inicio <span class="sr-only">(current)</span></a></li>
                    
              
                    <li><a href="editar_perfil.php" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-user'></i> Mi Perfil</a></li>
                    <li><a href="polizas.php" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-user'></i>  Mis Polizas</a></li>

                   
                     <li class="dropdown">
    <a href="#" class="dropdown-toggle nav-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='glyphicon glyphicon-user'></i>  Dependiente <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li><a href="dependiente.php">Solicitar dependiente</a></li>
        <li><a href="verdependiente.php">Ver dependiente</a></li>
        
    </ul>
</li>

                    
                     <li><a href="../web/login.php" class="nav-btn"><i class='glyphicon glyphicon-off'></i> Cerrar Seccion</a></li>

                </ul>
       
            </div>
        </div>
    </nav>
   </div>
<body>

<main>
    <section>
        <?php
        if ($result->num_rows > 0) {
            // Mostrar los dependientes en una tabla
            echo "<h2 style='text-align: center;'>Dependientes</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Cédula</th><th>Relación con el Titular</th><th>Fecha de Nacimiento</th><th>Sexo</th><th>Correo Electrónico</th><th>Estado</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["Nombre_Depe"] . "</td>";  
                echo "<td>" . $row["Apellido_Depe"] . "</td>";
                echo "<td>" . $row["Cedula_Depe"] . "</td>";
                echo "<td>" . $row["Relacion_Depe_Titu"] . "</td>";
                echo "<td>" . $row["Fecha_Naci_Depe"] . "</td>";
                echo "<td>" . $row["Sexo_Depe"] . "</td>";
                echo "<td>" . $row["Correo_Ele_Depe"] . "</td>";
                echo "<td>" . $row["Estado"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron dependientes asociados.";
        }
        ?>
    </section>
</main>

<footer>
    <p>© 2024 Tu Aseguradora. Todos los derechos reservados.</p>
</footer>

<script src="../js/scripts.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</body>
</html>
