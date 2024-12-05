<?php
session_start();


if (!isset($_SESSION["usuario"])) {
    
    header("Location: login.php");
    exit(); 
}

// Procesar el formulario de registro si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $relacion = $_POST['relacion'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $sexo = $_POST['sexo'];
    $correo = $_POST['correo'];
    $cedula_usuario = $_SESSION["usuario"]; 

    // Establecer conexión a la base de datos
    $conexion = new mysqli("mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com", "admin", "12345678", "mediccare");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Preparar la consulta SQL para insertar un nuevo dependiente
    $consulta = $conexion->prepare("INSERT INTO Dependiente (Titular_ID, Nombre_Depe, Apellido_Depe, Cedula_Depe, Relacion_Depe_Titu, Fecha_Naci_Depe, Sexo_Depe, Correo_Ele_Depe, cedula_pasaporte) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Vincular los parámetros con los valores del formulario y la cédula del usuario
    $consulta->bind_param("sssssssss", $cedula_usuario, $nombre, $apellido, $cedula, $relacion, $fecha_nacimiento, $sexo, $correo, $cedula_usuario);

    // Ejecutar la consulta
    if ($consulta->execute()) {
        // Redirigir al administrador para que apruebe el registro
        header("Location: verdependiente.php");
        exit();
    } else {
        echo "Error al registrar el dependiente: " . $conexion->error;
    }

    // Cerrar la conexión y la consulta
    $consulta->close();
    $conexion->close();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Nuevo Dependiente</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../img/imag.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
    <style>
        
        .form-container {
            width: 50%; 
            margin: 0 auto; 
            padding: 20px; 
            border: 1px solid #ccc; 
            border-radius: 10px; 
        }
        
        form label {
            display: block; 
            margin-bottom: 10px; 
        }
        form input[type="text"],
        form input[type="date"],
        form input[type="email"],
        form input[type="submit"] {
            width: 100%; 
            padding: 10px; 
            margin-bottom: 15px; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
        }
        form input[type="submit"] {
            background-color: #007bff; 
            color: #fff; 
            cursor: pointer; 
        }
        form input[type="submit"]:hover {
            background-color: #0056b3; 
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Registro de Nuevo Dependiente</h1>
    
   
    <div class="form-container">
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>
            
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" required>
            
            <!-- Campo oculto para la cédula del usuario -->
            <input type="hidden" id="cedula_pasaporte" name="cedula_pasaporte" value="<?php echo $_SESSION["usuario"]; ?>">
            
            <label for="relacion">Relación con el Titular:</label>
            <input type="text" id="relacion" name="relacion" required>
            
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
            
            <label for="sexo">Sexo:</label>
            <input type="text" id="sexo" name="sexo" required>
            
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" required>
            
            <input type="submit" value="Enviar para Revisión">
        </form>
    </div>
</body>
</html>


