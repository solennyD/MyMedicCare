<?php
session_start();

// Verificar si el usuario está autenticado y es un administrador
if (!isset($_SESSION["administrador"])) {
    // Si no está autenticado como administrador, redirigir al usuario al inicio de sesión del administrador
    header("Location: login_administrador.php");
    exit(); // Detener la ejecución del script después de redirigir
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "mediccare");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener la lista de dependientes de la base de datos
$sql = "SELECT * FROM dependiente";
$resultado = $conexion->query($sql);

$dependientes = [];
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $dependientes[] = $fila;
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Dependiente</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos CSS */
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Lista de Dependientes</h1>
        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Titular ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cédula</th>
                        <th>Relación con el Titular</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Sexo</th>
                        <th>Correo Electrónico</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dependientes as $dependiente): ?>
                        <tr>
                            <td><?php echo $dependiente["Titular_ID"]; ?></td>
                            <td><?php echo $dependiente["Nombre_Depe"]; ?></td>
                            <td><?php echo $dependiente["Apellido_Depe"]; ?></td>
                            <td><?php echo $dependiente["Cedula_Depe"]; ?></td>
                            <td><?php echo $dependiente["Relacion_Depe_Titu"]; ?></td>
                            <td><?php echo $dependiente["Fecha_Naci_Depe"]; ?></td>
                            <td><?php echo $dependiente["Sexo_Depe"]; ?></td>
                            <td><?php echo $dependiente["Correo_Ele_Depe"]; ?></td>
                            <td><a href="eliminar_dependiente.php?id=<?php echo $dependiente["id"]; ?>" class="button">Eliminar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p><a href="pagina_de_administrador.php" class="button">Volver al Inicio</a></p>
    </div>
</body>
</html>
