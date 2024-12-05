<?php
session_start();

// Verificar si el usuario está autenticado y es un administrador
if (!isset($_SESSION["administrador"])) {
    // Si no está autenticado como administrador, redirigir al usuario al inicio de sesión del administrador
    header("Location: login_administrador.php");
    exit(); // Detener la ejecución del script después de redirigir
}

// Verificar si hay datos de nuevo dependiente en la sesión
if (isset($_SESSION['nuevo_dependiente'])) {
    $nuevo_dependiente = $_SESSION['nuevo_dependiente'];
} else {
    // Si no hay datos de nuevo dependiente, redirigir a la página de inicio o a otra página apropiada
    header("Location: nodependiente.php");
    exit();
}

// Procesar la acción del administrador
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['aprobar'])) {
        // Acción de aprobar: Agregar el dependiente a la base de datos
        $conexion = new mysqli("mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com", "admin", "12345678", "mediccare");

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

       
        $nombre = $nuevo_dependiente['nombre'];
        $apellido = $nuevo_dependiente['apellido'];
        $cedula = $nuevo_dependiente['cedula'];
        $relacion = $nuevo_dependiente['relacion'];
        $fecha_nacimiento = $nuevo_dependiente['fecha_nacimiento'];
        $sexo = $nuevo_dependiente['sexo'];
        $correo = $nuevo_dependiente['correo'];

        $consulta = $conexion->prepare("INSERT INTO dependiente (Titular_ID, Nombre_Depe, Apellido_Depe, Cedula_Depe, Relacion_Depe_Titu, Fecha_Naci_Depe, Sexo_Depe, Correo_Ele_Depe) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $consulta->bind_param("isssssss", $titular_id, $nombre, $apellido, $cedula, $relacion, $fecha_nacimiento, $sexo, $correo);
        $consulta->execute();

        // Limpiar los datos de nuevo dependiente de la sesión después de agregarlo a la base de datos
        unset($_SESSION['nuevo_dependiente']);

        // Redirigir a una página de confirmación
        header("Location: confirmacion_aprobacion.php");
        exit();
    } elseif (isset($_POST['rechazar'])) {
        // Acción de rechazar: Redirigir a una página de rechazo o mostrar un mensaje de rechazo en esta misma página
        // Limpiar los datos de nuevo dependiente de la sesión sin agregarlo a la base de datos
        unset($_SESSION['nuevo_dependiente']);

        // Redirigir a una página de rechazo
        header("Location: mensaje_rechazo.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Revisión de Nuevo Dependiente</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1 class="title">Revisión de Nuevo Dependiente</h1>
    
    <!-- Mostrar los datos del nuevo dependiente para revisión -->
    <div class="container">
        <div class="info">
            <p><strong>Nombre:</strong> <?php echo $nuevo_dependiente['nombre']; ?></p>
            <p><strong>Apellido:</strong> <?php echo $nuevo_dependiente['apellido']; ?></p>
            <p><strong>Cédula:</strong> <?php echo $nuevo_dependiente['cedula']; ?></p>
            <p><strong>Relación con el Titular:</strong> <?php echo $nuevo_dependiente['relacion']; ?></p>
            <p><strong>Fecha de Nacimiento:</strong> <?php echo $nuevo_dependiente['fecha_nacimiento']; ?></p>
            <p><strong>Sexo:</strong> <?php echo $nuevo_dependiente['sexo']; ?></p>
            <p><strong>Correo Electrónico:</strong> <?php echo $nuevo_dependiente['correo']; ?></p>
        </div>
        
        <!-- Formulario para que el administrador apruebe o rechace el registro -->
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input class="button" type="submit" name="aprobar" value="Aprobar">
            <input class="button" type="submit" name="rechazar" value="Rechazar">
        </form>
    </div>
</body>
</html>
