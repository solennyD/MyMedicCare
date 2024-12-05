<?php
// Establecer conexión a la base de datos
$servername = "mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "12345678";
$dbname = "mediccare";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$apellidos = $_POST['apellidos'];
$cedula = $_POST['cedula'];
$correo = $_POST['correo'];
$estatus = isset($_POST['estatus']) ? $_POST['estatus'] : 'inactivo';
$fecha = $_POST['fecha'];
$nombres = $_POST['nombres'];
$telefono = $_POST['telefono'];

// Verificar si la cédula ya tiene una cita agendada
$sql = "SELECT * FROM cita WHERE cedula = '$cedula'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // La cédula ya tiene una cita agendada, redirigir a la página de cita existente
    header("Location: cita_existente.php?cedula=$cedula");
    exit();
} else {
    // Insertar los datos en la base de datos
    $sql = "INSERT INTO cita (apellidos, cedula, correo, estatus, fecha_registro, nombres, telefono)
            VALUES ('$apellidos', '$cedula', '$correo', '$estatus', '$fecha', '$nombres', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        // La cita se agendó correctamente, redirigir a la página de cita agendada
        header("Location: cita_agendada.php?apellidos=$apellidos&cedula=$cedula&correo=$correo&estatus=$estatus&fecha=$fecha&nombres=$nombres&telefono=$telefono&status=success");
        exit();
    } else {
        // Hubo un error al agendar la cita
        header("Location: cita_agendada.php?status=error");
        exit();
    }
}

// Cerrar conexión a la base de datos
$conn->close();
?>

