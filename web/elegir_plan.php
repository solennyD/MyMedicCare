<?php
session_start();

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
</head>
<body>
    <h1>Elegir Plan - MedicCare</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="plan_id">Selecciona tu plan:</label>
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
