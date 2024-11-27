<?php
session_start();
//evita que se el navegador me guarde cachet
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
//header("Expires: 0");  // Fecha en el pasado

// Verificar si el usuario está autenticado
if(!isset($_SESSION["cedula_pasaporte"])) {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión si no está autenticado
    exit;
}

// Obtener la cédula del usuario autenticado
$cedula_pasaporte = $_SESSION["cedula_pasaporte"];

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mediccare";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el usuario ya tiene un plan asignado
$sql_verificar_plan = "SELECT * FROM plan_usuario WHERE cedula_pasaporte='$cedula_pasaporte'";
$result_verificar_plan = $conn->query($sql_verificar_plan);

if ($result_verificar_plan->num_rows > 0) {
    // Si el usuario ya tiene un plan asignado, redirigir a la página mi_plan.php
    header("Location: mi_plan.php");
    exit;
}

// Si se envió el formulario de selección de plan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["plan_id"])) {
    // Recibir el ID del plan seleccionado
    $plan_id = $_POST["plan_id"];

    // Insertar datos en la tabla plan_usuario
    $sql = "INSERT INTO plan_usuario (cedula_pasaporte, plan_id) VALUES ('$cedula_pasaporte', $plan_id)";
    
    if ($conn->query($sql) === TRUE) {
        echo "¡Plan seleccionado correctamente!";
        // Después de seleccionar el plan, redirigir a la página mi_plan.php
        header("Location: mi_plan.php");
        exit;
    } else {
        echo "Error al seleccionar el plan: " . $conn->error;
    }
}

// Consulta para obtener los planes disponibles
$sql_obtener_planes = "SELECT * FROM plan";
$result_obtener_planes = $conn->query($sql_obtener_planes);

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegir Plan - MedicCare</title>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegir Plan - MedicCare</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f8fc; /* Fondo azul claro */
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
            width: 400px;
            text-align: center;
        }

        label {
            font-size: 1em;
            color: #5b8ab2; /* Azul suave */
            margin-bottom: 5px;
            display: block;
        }

        select {
            width: 50%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con transparencia */
            font-size: 1em;
        }

        input[type="submit"] {
            width: 70%;
            padding: 12px;
            background-color: #5b8ab2; /* Azul claro */
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

        .inf{
            color:black;
        }
    </style>
</head>

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
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h1>Elegir Plan - MedicCare</h1>
        <label for="plan_id"><h3 class="inf">Selecciona tu plan:</h3></label>
        <select name="plan_id" id="plan_id">
            <?php
            // Mostrar opciones de plan
            if ($result_obtener_planes->num_rows > 0) {
                while($row = $result_obtener_planes->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                }
            }
            ?>
        </select>
        <br><br>
        <input type="submit" value="Seleccionar Plan">
    </form>
</body>
</html>
