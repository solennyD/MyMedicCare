<?php
session_start();
//evita que se el navegador me guarde cachet
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
//header("Expires: 0");  // Fecha en el pasado

// Verificar si el usuario está autenticado
if(!isset($_SESSION["cedula_pasaporte"])) {
    // Si no está autenticado, verificar si se envió el formulario de inicio de sesión
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se enviaron las credenciales de inicio de sesión
        if(isset($_POST["cedula_pasaporte"])) {
            // Recibir cédula o pasaporte del formulario de inicio de sesión
            $cedula_pasaporte = $_POST["cedula_pasaporte"];

            // Conexión a la base de datos
            $servername = "mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com";
            $username = "admin";
            $password = "12345678";
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa; /* Azul claro muy suave */
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            font-size: 2em;
            color: #5b8ab2; /* Azul suave para el encabezado */
            margin-bottom: 20px;
        }

        form {
            background-color: rgba(91, 138, 178, 0.1); /* Azul suave con transparencia */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: center;
        }

        label {
            font-size: 1em;
            color: black; /* Azul suave */
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"] {
            width: 70%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con transparencia */
            font-size: 1em;
        }

        input[type="submit"] {
            width: 75%;
            padding: 12px;
            background-color: #007bff; /* Azul claro */
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #4a7f98; /* Azul más oscuro en hover */
        }

        p {
            color: #d9534f; /* Rojo suave para mensajes de error */
            font-size: 1em;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <header>
        
    <div class="button">
    <div class="button" style="position: absolute; top: 10px; left: 10px;">
        <a href="user.php" class="btn primary" style="display: inline-flex; align-items: center; text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; font-size: 16px; border-radius: 5px; transition: background-color 0.3s ease;">
            <i class="fas fa-arrow-left" style="margin-right: 8px;"></i> INICIO
        </a>
    </div>
    </header>


    <?php
    if(isset($error_message)) {
        echo "<p>$error_message</p>";
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h1>Iniciar Sesión - MedicCare</h1>
        <label for="cedula_pasaporte"><h3>Cédula o Pasaporte:</h3></label>
        <input type="text" id="cedula_pasaporte" name="cedula_pasaporte" required><br><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>



