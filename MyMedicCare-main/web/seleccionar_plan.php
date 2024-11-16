<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["cedula_pasaporte"])) {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión si no está autenticado
    exit;
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mediccare";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener todos los planes disponibles
$sql_obtener_planes = "SELECT * FROM plan";
$result_obtener_planes = $conn->query($sql_obtener_planes);

// Manejo del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $plan_id = $_POST["plan_id"];
    $cedula_pasaporte = $_SESSION["cedula_pasaporte"];

    // Consulta para insertar el plan seleccionado en la tabla plan_usuario
    $sql_insertar_plan_usuario = "INSERT INTO plan_usuario (cedula_pasaporte, plan_id) VALUES ('$cedula_pasaporte', '$plan_id')";

    if ($conn->query($sql_insertar_plan_usuario) === TRUE) {
        echo "<script>alert('Plan seleccionado exitosamente.')</script>";
        echo "<script>window.location.href='mi_plan.php'</script>";
    } else {
        echo "Error: " . $sql_insertar_plan_usuario . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Plan - MedicCare</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Seleccionar Plan - MedicCare</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="plan_id">Seleccione un plan:</label>
        <select name="plan_id" id="plan_id">
            <?php
            // Mostrar opciones de los planes disponibles
            if ($result_obtener_planes->num_rows > 0) {
                while($row_plan = $result_obtener_planes->fetch_assoc()) {
                    echo "<option value='" . $row_plan["id"] . "'>" . $row_plan["nombre"] . " - " . $row_plan["descripcion"] . "</option>";
                }
            } else {
                echo "<option value=''>No hay planes disponibles</option>";
            }
            ?>
        </select>
        <br><br>
        <input type="submit" value="Seleccionar Plan">
    </form>
</body>
</html>
