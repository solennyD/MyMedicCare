<?php
// Verificar si se han recibido los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han recibido todos los campos necesarios
    if (isset($_POST["nombre"]) && isset($_POST["especialidad"]) && isset($_POST["direccion"]) && isset($_POST["telefono"]) && isset($_POST["email"])) {
        // Recibir los datos del formulario
        $nombre = $_POST["nombre"];
        $especialidad = $_POST["especialidad"];
        $direccion = $_POST["direccion"];
        $telefono = $_POST["telefono"];
        $email = $_POST["email"];
        
        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "mediccare");

        // Verificar si hay errores de conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Preparar la consulta SQL para insertar el nuevo proveedor médico
        $sql = "INSERT INTO proveedoresmedicos (Nombre_Prov, Especialidad_Prov, Direccion_Prov, Telefono_Prov, Correo_Ele_Prov) VALUES (?, ?, ?, ?, ?)";
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param("sssss", $nombre, $especialidad, $direccion, $telefono, $email);

        // Ejecutar la consulta
        if ($consulta->execute()) {
            // Redireccionar a la página de ver proveedores médicos
            header("Location: verProveedore.php");
            exit();
        } else {
            echo "Error al agregar el proveedor médico.";
        }

        // Cerrar consulta y conexión
        $consulta->close();
        $conexion->close();
    } else {
        echo "Todos los campos son requeridos.";
    }
} else {
    // Si se intenta acceder directamente a este script sin datos POST, redireccionar a la página de agregar proveedor
    header("Location: agregar_proveedor.php");
    exit();
}
?>
