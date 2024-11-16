<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
    // Si el usuario no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: login.php");
    exit();
}

// Verificar si se ha enviado el formulario de aprobación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_producto"])) {
    // Obtener el ID del producto a aprobar
    $id_producto = $_POST["id_producto"];

    // Establecer conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "mediccare");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para actualizar el estado del producto a 'Aprobado'
    $sql = "UPDATE nuevos_productos SET estado = 'Aprobado' WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_producto);

    if ($stmt->execute()) {
        echo "El producto ha sido aprobado correctamente.";
    } else {
        echo "Error al aprobar el producto: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}

// Consulta SQL para obtener todos los nuevos productos
$conexion = new mysqli("localhost", "root", "", "mediccare");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT * FROM nuevos_productos";
$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Nuevos Productos</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            display: inline;
        }
        .aprobar-btn {
            background-color: #4CAF50;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .aprobar-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Visualizar Nuevos Productos</h1>
    </header>
   
    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Producto</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $fila['id']; ?></td>
                    <td><?php echo $fila['nombre_producto']; ?></td>
                    <td><?php echo $fila['descripcion']; ?></td>
                    <td><?php echo $fila['estado']; ?></td>
                    <td>
                        <?php if ($fila['estado'] !== 'Aprobado'): ?>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="id_producto" value="<?php echo $fila['id']; ?>">
                                <button type="submit" class="aprobar-btn">Aprobar</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos y liberar recursos
$conexion->close();
?>
