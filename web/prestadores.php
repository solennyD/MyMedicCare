<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Prestadores - MedicCare</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../img/imag.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        table {
            margin: auto;
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="./pagina_de_administrador.php" class="nav-btn"><i class='glyphicon glyphicon-started-alt'></i> Inicio</a></li>
                    <li class="active"><a href="prestadores.php" class="nav-btn"><i class='glyphicon glyphicon-user'></i> Prestadores <span class="sr-only">(current)</span></a></li>
                    <li><a href="farmacias.html" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-plus-sign'></i> Farmacias</a></li>
                    <li><a href="hospitales.php" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-user'></i> Hospitales</a></li>
                    <li><a href="../web/login.php" class="nav-btn"><i class='glyphicon glyphicon-off'></i> Cerrar Sección</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <h1>Buscar Prestadores</h1>
    <form action="" method="POST">
        <label for="tipo_prestador">Seleccionar tipo de prestador:</label>
        <select name="tipo_prestador" id="tipo_prestador">
            <option value="clinica">Clínica</option>
            <option value="prestador">Prestador</option>
            <option value="hospital">Hospital</option>
        </select>
        <input type="submit" value="Buscar">
    </form>
    
    <?php
    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Establecer conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "mediccare");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        
        // Obtener el tipo de prestador seleccionado
        $tipo_prestador = $_POST["tipo_prestador"];
        
        // Realizar la consulta según el tipo de prestador seleccionado
        switch ($tipo_prestador) {
            case "clinica":
                $sql = "SELECT * FROM clinicas";
                break;
            case "prestador":
                $sql = "SELECT * FROM prestador";
                break;
            case "hospital":
                $sql = "SELECT * FROM hospitales";
                break;
        }
        
        // Ejecutar la consulta
        $result = $conexion->query($sql);
        
        // Mostrar los resultados en una tabla
        if ($result->num_rows > 0) {
            echo "<h2>Resultados:</h2>";
            echo "<table>";
            echo "<thead><tr>";
            switch ($tipo_prestador) {
                case "clinica":
                    echo "<th>ClinicaID</th>";
                    echo "<th>Nombre_Cli</th>";
                    echo "<th>Direccion_Cli</th>";
                    echo "<th>Telefono_Cli</th>";
                    echo "<th>Correo_Ele_Cli</th>";
                    break;
                case "prestador":
                    echo "<th>ID</th>";
                    echo "<th>Nombre_Prestador</th>";
                    echo "<th>Direccion</th>";
                    echo "<th>Telefono</th>";
                    echo "<th>Email</th>";
                    break;
                case "hospital":
                    echo "<th>HospitalID</th>";
                    echo "<th>Nombre_Hos</th>";
                    echo "<th>Direccion_Hos</th>";
                    echo "<th>Telefono_Hos</th>";
                    echo "<th>Correo_Ele_Hos</th>";
                    break;
            }
            echo "</tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No se encontraron resultados.</p>";
        }
        
        // Cerrar conexión
        $conexion->close();
    }
    ?>
</body>
</html>
