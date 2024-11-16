<?php
session_start();

// Verificar si el administrador ha iniciado sesión
if (!isset($_SESSION["administrador"])) {
    // Si el administrador no ha iniciado sesión, redirigirlo al formulario de inicio de sesión del administrador
    header("Location: login_administrador.php");
    exit();
}

// Obtener la cédula del administrador desde la sesión
$cedula_administrador = $_SESSION["administrador"];

// Establecer conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "mediccare");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Realizar una consulta para obtener el nombre del administrador basado en la cédula almacenada en la sesión
$consulta_nombre = $conexion->prepare("SELECT Nombre FROM administrador WHERE Cedula = ?");
$consulta_nombre->bind_param("s", $cedula_administrador);
$consulta_nombre->execute();
$resultado_nombre = $consulta_nombre->get_result();

// Obtener el nombre del administrador
if ($resultado_nombre->num_rows > 0) {
    $fila_nombre = $resultado_nombre->fetch_assoc();
    $nombre_administrador = $fila_nombre["Nombre"];
} else {
    // Manejar el caso en el que no se encuentre el administrador en la base de datos
    $nombre_administrador = "Administrador Desconocido";
}

// Cerrar la consulta de obtener el nombre del administrador
$consulta_nombre->close();
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido, <?php echo $nombre_administrador; ?> - Página del Administrador</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Tus enlaces CSS y otros metadatos -->
    <link rel="shortcut icon" type="image/png" href="../img/imag.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
    <style>
        /* Estilos adicionales */
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .welcome-bar {
            background-color: purple;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        h1 {
            margin-top: 50px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
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
                    <li class="active"><a href="modificarPerfil.php" class="nav-btn"><i class='glyphicon glyphicon-user'></i> Perfil<span class="sr-only">(current)</span></a></li>
                    
              
                    <li><a href="usuario.php" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-user'></i> Usuarios</a></li>

                    <li><a href="addadmin.php" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-plus'></i> Nuevo administrador</a></li>


                    <li><a href="historalMedico.html" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-list-alt'></i> Historial medico</a></li>
                                     <li class="dropdown">
    <a href="#" class="dropdown-toggle nav-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='glyphicon glyphicon-user'></i>  Administrar <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li><a href="ver_clinicas.php">Clinicas</a></li>
        <li><a href="centroMedicos.php">Centros Medicos</a></li>
        <li><a href="agregarClinica.html">Farmacias</a></li>
         <li><a href="prestador.php">Prestadore</a></li>
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

                    
                     <li><a href="../web/loginadmin.php" class="nav-btn"><i class='glyphicon glyphicon-off'></i> Salir</a></li>

                </ul>
       
            </div>
        </div>
    </nav>
   </div>
<body>

    <!-- Barra de bienvenida púrpura -->
    <div class="welcome-bar" id="welcome-bar">
        <p>Bienvenido, <?php echo $nombre_administrador; ?></p>
    </div>

    <main>
        <section>
            <h2>Panel de Control del Administrador</h2>
            <?php  
           if (isset($_GET['eliminar_id'])) {
    // Obtener el ID del usuario a eliminar
    $eliminar_id = $_GET['eliminar_id'];

    // Query para eliminar el usuario
    $sql_eliminar = "DELETE FROM usuario WHERE id = ?";
    $stmt_eliminar = $conexion->prepare($sql_eliminar);
    $stmt_eliminar->bind_param("i", $eliminar_id);
    $stmt_eliminar->execute();

    // Verificar si se eliminó correctamente el usuario
    if ($stmt_eliminar->affected_rows > 0) {
        $mensaje = "El usuario se ha eliminado correctamente.";
    } else {
        $mensaje = "No se pudo eliminar el usuario.";
    }

    // Cerrar la declaración
    $stmt_eliminar->close();
}

// Query para obtener todos los usuarios

            // Query para obtener todas las solicitudes de reembolso
            $sql = "SELECT id, cedula_pasaporte, fecha_solicitud, monto, estado, descripcion, archivo_adjunto FROM solicitud_reembolso";
            $resultado = $conexion->query($sql);
            ?>
            <h1 style="text-align: center;">Lista de Solicitudes de Reembolso</h1>

            <!-- Mostrar mensaje de eliminación si existe -->
            <?php if (isset($mensaje)): ?>
                <div style="text-align: center; padding: 10px; background-color: #f44336; color: white;">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif;
            ?>

            <!-- Formulario con tabla y mensaje de advertencia -->
            <form>
                <h3>Lista de Solicitudes de Reembolso</h3>
                <?php if (isset($mensaje)): ?>
                    <div style="text-align: center; padding: 10px; background-color: #f44336; color: white;">
                        <?php echo $mensaje; ?>
                    </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table border="1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cédula o Pasaporte</th>
                                <th>Fecha de Solicitud</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th>Descripción</th>
                                <th>Archivo Adjunto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($fila = $resultado->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $fila['id']; ?></td>
                                    <td><?php echo $fila['cedula_pasaporte']; ?></td>
                                    <td><?php echo $fila['fecha_solicitud']; ?></td>
                                    <td><?php echo $fila['monto']; ?></td>
                                    <td><?php echo $fila['estado']; ?></td>
                                    <td><?php echo $fila['descripcion']; ?></td>
                                    <td><?php echo $fila['archivo_adjunto']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Mensaje de advertencia -->
                <div class="alert alert-warning" role="alert">
                    ¡Cuidado con los datos que manipula!
                </div>
            </form>
        </section>
    </main>

    <!-- JavaScript para hacer que la barra de bienvenida desaparezca después de 3 segundos -->
    <script>
        setTimeout(function() {
            document.getElementById('welcome-bar').style.display = 'none';
        }, 3000);
    </script>


    <script src="../js/scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
