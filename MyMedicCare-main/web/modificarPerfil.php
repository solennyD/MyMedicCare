<?php
session_start();

// Verificar si el usuario está autenticado
if(!isset($_SESSION["cedula_pasaporte"])) {
    // Si no está autenticado, verificar si se envió el formulario de inicio de sesión
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se enviaron las credenciales de inicio de sesión
        if(isset($_POST["cedula_pasaporte"])) {
            // Recibir cédula o pasaporte del formulario de inicio de sesión
            $cedula_pasaporte = $_POST["cedula_pasaporte"];

            // Conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mediccare";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Verificar si la cédula o pasaporte existe en la base de datos
            $sql = "SELECT * FROM usuario WHERE cedula_pasaporte='$cedula_pasaporte'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                // Credenciales válidas, iniciar sesión y redirigir a la página de edición de perfil
                $_SESSION["cedula_pasaporte"] = $cedula_pasaporte;
                header("Location: editar_perfil.php");
                exit;
            } else {
                $error_message = "Cédula o pasaporte inválido.";
            }
            $conn->close();
        }
    }
}

// Si el usuario está autenticado, redirigir a la página de edición de perfil
if(isset($_SESSION["cedula_pasaporte"])) {
    header("Location: editar_perfil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - MedicCare</title>
</head>
<body>
    <h1>Iniciar Sesión - MedicCare</h1>
    <?php
    if(isset($error_message)) {
        echo "<p>$error_message</p>";
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="cedula_pasaporte">Cédula o Pasaporte:</label>
        <input type="text" id="cedula_pasaporte" name="cedula_pasaporte" required><br><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>



