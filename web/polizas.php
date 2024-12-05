<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pólizas del Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .title-bar {
            background-color: #007bff;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
        }
        .poliza-container {
            margin: 0 auto;
            width: 80%;
            text-align: left;
        }
        .poliza-container h2 {
            color: #007bff;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="title-bar">
        <h1>Mis Pólizas</h1>
    </div>
    
    <div class="poliza-container">
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
        $servername = "mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com";
        $username = "admin";
        $password = "12345678";
        $dbname = "mediccare";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta para obtener el plan del usuario
        $sql_obtener_plan_usuario = "SELECT plan_id FROM plan_usuario WHERE cedula_pasaporte = '$cedula_pasaporte'";
        $result_obtener_plan_usuario = $conn->query($sql_obtener_plan_usuario);

        if ($result_obtener_plan_usuario->num_rows > 0) {
            // Si el usuario tiene un plan registrado, obtener el plan_id
            $row_plan_usuario = $result_obtener_plan_usuario->fetch_assoc();
            $plan_id = $row_plan_usuario["plan_id"];
            
            // Consulta para obtener los detalles del plan
            $sql_obtener_detalles_plan = "SELECT * FROM plan WHERE id = $plan_id";
            $result_obtener_detalles_plan = $conn->query($sql_obtener_detalles_plan);

            if ($result_obtener_detalles_plan->num_rows > 0) {
                // Si se encuentran detalles del plan, crear las pólizas
                while ($row_plan = $result_obtener_detalles_plan->fetch_assoc()) {
                    $nombre_plan = $row_plan["nombre"];
                    $descripcion_plan = $row_plan["descripcion"];
                    $precio_plan = $row_plan["precio"];
                    $duracion_meses = $row_plan["duracion_meses"];
                    
                    // Aquí puedes crear las pólizas con los detalles obtenidos del plan
                    echo "<h2>Póliza: $nombre_plan</h2>";
                    echo "<p>Descripción: $descripcion_plan</p>";
                    echo "<p>Precio: $precio_plan</p>";
                    echo "<p>Duración en meses: $duracion_meses</p>";
                    echo "<hr>";
                }
            } else {
                echo "No se encontraron detalles del plan.";
            }
        } else {
            echo "El usuario no tiene un plan registrado.";
        }

        $conn->close();
        ?>
    </div>
    
    <a href="javascript:history.back()" class="back-link">Volver Atrás</a>
</body>
</html>
