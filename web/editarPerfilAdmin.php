<?php
session_start();

//evita que se el navegador me guarde cachet
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
//header("Expires: 0");  // Fecha en el pasado

// Verificar si el usuario está autenticado
if(!isset($_SESSION["cedula"])) {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión si no está autenticado
    exit;
}

// Obtener la cédula o pasaporte del usuario autenticado
$cedula = $_SESSION["cedula"];

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
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
   // $cedula = $_POST['cedula'];
    $puesto = $_POST['puesto'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $correo_electronico = $_POST['correo'];
    $contrasena = $_POST['contrasena']; 
  

    // Actualizar los datos en la base de datos
    $sql = "UPDATE administrador SET nombre='$nombre', apellido='$apellido', puesto='$puesto' /*, cedula='$cedula'*/, fecha_nacimiento='$fecha_nacimiento', Correo_Electronico='$correo_electronico', contrasena='$contrasena' WHERE cedula='$cedula'";


    if ($conn->query($sql) === TRUE) {
        echo "<h3 style= 'background: #90EE90 ; text-align: center;';> ¡Perfil actualizado correctamente!</h3>";
    } else {
        echo " <h3 style= 'background: red ; text-align: center;';> ¡Error al actualizar el perfil!</h3>" . $conn->error;
    }
} else {
    // Obtener los datos del usuario de la base de datos
    $sql = "SELECT * FROM administrador WHERE cedula='$cedula'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row["Nombre"];
        $apellido = $row["Apellido"];
       // $cedula = $row["Cedula"];
        $puesto = $row["Puesto"];
        $fecha_nacimiento = $row["Fecha_Nacimiento"];
        $correo_electronico = $row["Correo_Electronico"];
        $contrasena = $row["Contrasena"];
        
    }else{
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
                    <li class="active"><a href="./pagina_de_administrador.php" class="nav-btn"><i class='glyphicon glyphicon-user'></i> Inicio</a></li>
                    
              
                    <li><a href="usuario.php" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-user'></i> Usuarios</a></li>

                    <li><a href="addadmin.php" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-plus'></i> Nuevo administrador</a></li>


                    <li><a href="historalMedico.html" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-list-alt'></i> Historial medico</a></li>
                                     <li class="dropdown">
    <a href="#" class="dropdown-toggle nav-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='glyphicon glyphicon-user'></i>  Administrar <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li><a href="ver_clinicas.php">Clinicas</a></li>
        <li><a href="centroMedicos.php">Centros Medicos</a></li>
        <li><a href="agregarClinica.html">Farmacias</a></li>
         <li><a href="prestador.php">Prestadores</a></li>
          <li><a href="verProveedore.php">Proveedores Medicos</a></li>
           <li><a href="agregarClinica.html">Tratamientos Medicos</a></li>
            <li><a href="agregarClinica.html">Plan</a></li>
             <li><a href="agregarClinica.html">Plan de usuarios</a></li>
       
    </ul>
</li>

 <li class="dropdown">
                        <a href="#" class="dropdown-toggle nav-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='glyphicon glyphicon-edit'></i> Solicitudes <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="verdependiente.php"><i class='glyphicon glyphicon-user'></i> Dependientes</a></li>
                            <li><a href="visualizar_solicitud_reembolso.php"><i class='glyphicon glyphicon-usd'></i> ver solicitud de Reembolso</a></li>
                            <li><a href="visualizar_preautorizaciones.php"><i class='glyphicon glyphicon-usd'></i> Solicitud Preautorizaciones</a></li>
                            <li><a href="visualizar_nuevos_productos.php"><i class='glyphicon glyphicon-shopping-cart'></i> Solicitud de Nuevos Productos</a></li>
                        </ul>
                    </li>

                   
    <li class="dropdown">
    <a href="#" class="dropdown-toggle nav-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='glyphicon glyphicon-user'></i>  Dependiente <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li><a href="revisar_dependiente.php">Revisar dependiente</a></li>
        <li><a href="verdependiente.php">Ver dependiente</a></li>
        <li><a href="eliminardependiente.php">Eliminar dependiente</a></li>
    </ul>
</li>

                    
<li>
                     <!-- Formulario que enviará una solicitud POST para cerrar sesión -->
                        <form action="logout.php" method="post" style="display: inline;">
                        <button type="submit" name="logout" class="nav-btn" style="background: #1A76D1 ;  color: white; cursor: pointer; padding-top: 5% ; margin-top: 5% ;border: none">
                        <i class='glyphicon glyphicon-off'></i> Salir
                        </button>
                    </form>
                </li>

                </ul>
       
            </div>
        </div>
    </nav>
   </div>
    <div class="container">
        <h1>Editar Perfil - Administrador</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>">
            <label for="puesto">Puesto:</label>
            <input type="text" id="puesto" name="puesto" value="<?php echo $puesto; ?>">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?php echo $correo_electronico; ?>">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>">
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" value="<?php echo $contrasena; ?>">
            
            <input type="submit" value="Actualizar Perfil">
        </form>
    </div>

     <script src="../js/scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
