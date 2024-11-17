<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mediccare";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $puesto = $_POST['puesto'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $sexo = $_POST['sexo'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena']; 
    $hash_contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

    $sql = "INSERT INTO administrador (Nombre, Apellido, Cedula, Puesto, Fecha_Nacimiento, Sexo, Correo_Electronico, Contrasena)
            VALUES ('$nombre', '$apellido', '$cedula', '$puesto', '$fecha_nacimiento', '$sexo', '$correo', '$hash_contrasena')";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: registro_exitoso.php");
        exit();
    } else {
       
        echo "Error al registrar el administrador: " . $conn->error;
    }

   
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Administrador</title>
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../img/imag.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
     <link rel="stylesheet" href="../css/bootstrap.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
</head>

<style>
        
        body {
            background-color: #f8f8f8;
        }
        form {
            width: 50%; 
            margin: 0 auto; 
            padding: 20px; 
            border: 1px solid #ccc; 
            border-radius: 10px; 
        }
        form label {
            display: block; 
            margin-bottom: 10px; 
        }
        form input[type="text"],
        form input[type="date"],
        form input[type="email"],
        form input[type="password"],
        form select,
        form input[type="submit"] {
            width: 100%; 
            padding: 10px; 
            margin-bottom: 15px; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
        }
        form input[type="submit"] {
            background-color: #007bff; 
            color: #fff; 
            cursor: pointer; 
        }
        form input[type="submit"]:hover {
            background-color: #0056b3;  
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Registrar Administrador</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>
        
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
        <br><br>
        
        <label for="cedula">Cédula:</label>
        <input type="text" id="cedula" name="cedula" required>
        <br><br>
        
        <label for="puesto">Puesto:</label>
        <input type="text" id="puesto" name="puesto" required>
        <br><br>
        
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
        <br><br>
        
        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            <option value="Otro">Otro</option>
        </select>
        <br><br>
        
        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required>
        <br><br>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br><br>
        
        <input type="submit" value="Registrar Administrador">
    </form>
</body>
</html>
