<?php
// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establecer conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mediccare";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cedula_pasaporte = $_POST['cedula_pasaporte'];
    $correo = $_POST['correo'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];

    // Verificar si ya existe una persona con la misma cédula o pasaporte
    $sql_verificar = "SELECT * FROM usuario WHERE cedula_pasaporte = '$cedula_pasaporte'";
    $resultado = $conn->query($sql_verificar);
    if ($resultado->num_rows > 0) {
        // Ya existe una cuenta con este número de documento
        echo "Ya existe una cuenta con este número de documento.";
        exit();
    }

    // Cifrar la contraseña
    $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar los datos en la tabla usuario
    $sql = "INSERT INTO usuario (nombre, apellido, cedula_pasaporte, correo, fecha_nacimiento, telefono, contrasena)
            VALUES ('$nombre', '$apellido', '$cedula_pasaporte', '$correo', '$fecha_nacimiento', '$telefono', '$contrasena_cifrada')";

    if ($conn->query($sql) === TRUE) {
        // Los datos se han insertado correctamente
        // Puedes redirigir al usuario a una página de confirmación o a cualquier otra página
        header("Location: registro_exitoso.php");
        exit();
    } else {
        // Hubo un error al insertar los datos
        echo "Error al registrar el usuario: " . $conn->error;
    }

    // Cerrar conexión a la base de datos
    $conn->close();
} else {
    // Si se intenta acceder directamente a este archivo sin enviar el formulario, redirigir a la página de registro
    header("Location: nuevocliente.php");
    exit();
}
?>

