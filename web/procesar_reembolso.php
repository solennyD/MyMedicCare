<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["cedula_pasaporte"])) {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión si no está autenticado
    exit;
}

// Obtener la cédula del usuario autenticado
$cedula_pasaporte = $_SESSION["cedula_pasaporte"];

// Conexión a la base de datos
$servername = "mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "12345678";
$dbname = "mediccare";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Validar y procesar la solicitud de reembolso
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $monto = $_POST["monto"];
    $descripcion = $_POST["descripcion"];
    
    // Subir el archivo adjunto
    $nombre_archivo = $_FILES["archivo"]["name"];
    $ruta_archivo = "documentos/" . basename($_FILES["archivo"]["name"]);
    if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta_archivo)) {
        // Insertar la solicitud de reembolso en la base de datos
        $sql = "INSERT INTO solicitud_reembolso (cedula_pasaporte, monto, descripcion, archivo_adjunto) 
                VALUES ('$cedula_pasaporte', '$monto', '$descripcion', '$ruta_archivo')";
        
        // Si la solicitud se procesa correctamente, mostrar un mensaje en azul y redirigir a la página 'solicitudes.php'
if ($conn->query($sql) === TRUE) {
    echo "<a href='solicitudes.php' style='color: blue;'>Solicitud de reembolso enviada correctamente. Haz clic aquí para ver tus solicitudes.</a>";
} else {
    echo "Error al enviar la solicitud de reembolso: " . $conn->error;
}

    } else {
        echo "Error al subir el archivo adjunto.";
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

