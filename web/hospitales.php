<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Clínicas</title>
            <link rel="stylesheet" href="css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../img/imag.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
     

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">


</head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Correo Electrónico</th>
        </tr>
    </thead>
    <tbody>

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
                    <li class="active"><a href="./user.php" class="nav-btn"><i class='glyphicon glyphicon-list-alt'></i> Inicio <span class="sr-only">(current)</span></a></li>
                    
              
                    <li><a href="usuario.php" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-user'></i> Usuarios</a></li>

                    <li><a href="historalMedico.html" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-user'></i> Historial medico</a></li>
                                     <li class="dropdown">
    <a href="#" class="dropdown-toggle nav-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='glyphicon glyphicon-user'></i>  Hospitales <span class="caret"></span></a>
    <ul class="dropdown-menu">
     
        <li><a href="eliminar+_hospital.php">Eliminar Hospitales</a></li>
        <li><a href="agregarClinica.html">Agregar Hospitales</a></li>
       
    </ul>
</li>     
                     <li><a href="../web/login.php" class="nav-btn"><i class='glyphicon glyphicon-off'></i> Cerrar Seccion</a></li>

                </ul>
       
            </div>
        </div>
    </nav>
   </div>
        <?php
        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "mediccare");

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Consulta SQL para obtener todas las clínicas
        $sql = "SELECT Nombre_Hos, Direccion_Hos, Telefono_Hos, Correo_Ele_Hos FROM hospitales";
        $result = $conexion->query($sql);

        // Mostrar los resultados en la tabla
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Nombre_Hos"] . "</td>";
                echo "<td>" . $row["Direccion_Hos"] . "</td>";
                echo "<td>" . $row["Telefono_Hos"] . "</td>";
                echo "<td>" . $row["Correo_Ele_Hos"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No se encontraron Hospitales.</td></tr>";
        }

        // Cerrar la conexión
        $conexion->close();
        ?>
    </tbody>
</table>
 </footer>
     <script src="../js/scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
