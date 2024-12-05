<?php
// Verificar si se ha iniciado sesión
session_start();
if (!isset($_SESSION["usuario"])) {
    // Si no se ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("Location: login.php");
    exit();
}

// Establecer conexión a la base de datos
$conexion = new mysqli("mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com", "admin", "12345678", "mediccare");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Realizar consulta para obtener los prestadores
$sql_prestadores = "SELECT nombre_prestador FROM prestador";
$resultado_prestadores = $conexion->query($sql_prestadores);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Preautorizaciones</title>
    <link rel="stylesheet" href="css/style.css">
     
    <style>
          body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: blue;
            color: white;
            text-align: center;
            padding: 1rem 0;
        }
        main {
            padding: 20px;
            margin: 20px;
        }
        h1, h2 {
            text-align: center;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Solicitar Preautorizaciones</h1>
    </header>
   
    <main>
        <section>
            <h2>Formulario de Solicitud de Preautorizaciones</h2>
            <form action="procesar_solicitud.php" method="POST">
                <label for="cedula_pasaporte">Cédula o Pasaporte:</label>
                <input type="text" id="cedula_pasaporte" name="cedula_pasaporte" required>
                <br>
                <label for="prestador">Prestador:</label>
                <select id="prestador" name="prestador" required>
                    <?php while ($fila = $resultado_prestadores->fetch_assoc()): ?>
                        <option value="<?php echo $fila['nombre_prestador']; ?>"><?php echo $fila['nombre_prestador']; ?></option>
                    <?php endwhile; ?>
                </select>
                <br>
                <label for="monto_solicitado">Monto Solicitado:</label>
                <input type="number" id="monto_solicitado" name="monto_solicitado" step="0.01" required>
                <br>
                <label for="fecha_solicitud">Fecha de Solicitud:</label>
                <input type="date" id="fecha_solicitud" name="fecha_solicitud" required>
                <br>
                <!-- Estado se llenará automáticamente -->
                <input type="hidden" id="estado" name="estado" value="En proceso">
                <br>
                <label for="tipo">Tipo:</label>
                <input type="text" id="tipo" name="tipo" required>
                <br>
                <button type="submit">Enviar Solicitud</button>
            </form>
        </section>
    </main>
</body>
</html>

