<?php
// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];

    // Conexión a la base de datos (debes establecer tus propias credenciales)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mediccare";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para insertar el nuevo centro médico
    $sql = "INSERT INTO centroatenmedi (Nombre_Centro, Direccion_CentroAntencionMed, Telefono_CentroAtencionMed, Correo_Ele_CentroAtencionMed)
            VALUES ('$nombre', '$direccion', '$telefono', '$correo')";

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo centro médico agregado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
} else {
    // Si no se han enviado los datos del formulario, redirigir a la página de agregar centro médico
    header("Location: agregar_centro.php");
    exit();
}
?>
