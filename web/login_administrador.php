<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = new mysqli("localhost", "root", "", "mediccare");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    if (isset($_POST["cedula_pasaporte"]) && isset($_POST["contrasena"])) {
        $cedula_pasaporte = $_POST["cedula_pasaporte"];
        $contrasena = $_POST["contrasena"];

        $consulta = $conexion->prepare("SELECT * FROM administrador WHERE Cedula = ? LIMIT 1");
        $consulta->bind_param("s", $cedula_pasaporte);
        $consulta->execute();
        $resultado = $consulta->get_result();

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            if (password_verify($contrasena, $fila["Contrasena"])) {
                $_SESSION["administrador"] = $fila["Cedula"];
                header("Location: pagina_de_administrador.php");
                exit();
            }
        }

        $error = "Cédula o contraseña incorrectas.";
    }

    $conexion->close();
}

header("Location: loginadmin.php"); // Redirigir en caso de que el inicio de sesión falle
echo "Datos incorrectos";
exit();
?>
