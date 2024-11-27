    <?php
session_start();


//evita que se el navegador me guarde cachet
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
//header("Expires: 0");  // Fecha en el pasado


// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
    // Si el usuario no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: login.php");
    exit();
}

// Obtener la cédula del usuario desde la sesión
$cedula_usuario = $_SESSION["usuario"];

// Establecer conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "mediccare");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Realizar una consulta para obtener el nombre del usuario basado en la cédula almacenada en la sesión
$consulta_nombre = $conexion->prepare("SELECT nombre FROM usuario WHERE cedula_pasaporte = ?");
$consulta_nombre->bind_param("s", $cedula_usuario);
$consulta_nombre->execute();
$resultado_nombre = $consulta_nombre->get_result();

// Obtener el nombre del usuario
if ($resultado_nombre->num_rows > 0) {
    $fila_nombre = $resultado_nombre->fetch_assoc();
    $nombre_usuario = $fila_nombre["nombre"];
} else {
    // Manejar el caso en el que no se encuentre el usuario en la base de datos
    $nombre_usuario = "Usuario Desconocido";
}

// Cerrar la consulta de obtener el nombre del usuario
$consulta_nombre->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido, <?php echo $nombre_usuario; ?> - Página del Usuario</title>
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
        /* Estilos adicionales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        header {
            background-color: #28a745;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-bottom: 20px;
        }
        main {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
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
                    <li class="active"><a href="elegir_plan.php" class="nav-btn"><i class='glyphicon glyphicon-list-alt'></i> Plan <span class="sr-only">(current)</span></a></li>
                    <li><a href="modificarPerfil.php" onclick="frmCliente()" class="nav-btn"> <i class='glyphicon glyphicon-user'></i> Mi Perfil</a></li>
                    

                        <li class="nav-btn"><a href="./consumos.php" class="nav-btn"><i class='glyphicon glyphicon-list'></i> Consumos <span class="sr-only">(current)</span></a></li>
                        <ul class="dropdown-menu">
                            <li><a href="medicamentos.php"><i class='glyphicon glyphicon-heart'></i> Medicamentos</a></li>
                            <li><a href="reembolso.html"><i class='glyphicon glyphicon-usd'></i> Reembolso</a></li>
                            <li><a href="#"><i class='glyphicon glyphicon-list-alt'></i> Consultas</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle nav-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='glyphicon glyphicon-edit'></i> Solicitudes <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="verdependiente.php"><i class='glyphicon glyphicon-user'></i> Dependientes</a></li>
                            <li><a href="reembolso.html"><i class='glyphicon glyphicon-usd'></i> Reembolso</a></li>
                            <li><a href="preautorizaciones.php"><i class='glyphicon glyphicon-usd'></i> Solicitar Preautorizaciones</a></li>
                            <li><a href="solicitarProdcto.php"><i class='glyphicon glyphicon-shopping-cart'></i> Nuevos Productos</a></li>
                        </ul>
                    </li>
                    <li>
                     <!-- Formulario que enviará una solicitud POST para cerrar sesión -->
                        <form action="logout.php" method="post" style="display: inline;">
                        <button type="submit" name="logout" class="nav-btn" style="background: #2889E4 ;  color: white; cursor: pointer; padding-top: 5% ; margin-top: 5% ;border: none">
                        <i class='glyphicon glyphicon-off'></i> Cerrar Sesión
                        </button>
                    </form>
                </li>

                </ul>
            </div>
        </div>
    </nav>

<body>
    <header>
        <h1>Bienvenido, <?php echo $nombre_usuario; ?></h1>
    </header>
   
    <main>
        <a href="polizas.php"><h2>Mis Pólizas</h2></a>

        <!-- Aquí puedes mostrar las pólizas del usuario -->
        
        <!-- A continuación, se muestra el gráfico de consumo -->
        <h2>Gráfico de Consumo de Medicamentos</h2>
        <div>
            <!-- Selector para el tipo de consumo -->
            <label for="tipoConsumo">Seleccionar tipo de consumo:</label>
            <select id="tipoConsumo">
                <option value="Anual">Anual</option>
                <option value="Mensual">Mensual</option>
            </select>
        </div>
        <div>
            <!-- Contenedor para el gráfico -->
            <canvas id="graficoConsumo"></canvas>
        </div>

        <!-- Ahora, vamos a mostrar la tabla de consumo -->
        <h2>Tabla de Consumo</h2>
        <table>
            <thead>
                <tr>
                    <th>Prestador</th>
                    <th>Monto Autorizado</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta SQL para obtener los datos de consumo del usuario actual
                $sql_consumo = "SELECT prestador, monto_autorizado, fecha, estado, tipo FROM consumo WHERE cedula_pasaporte = ?";
                $consulta_consumo = $conexion->prepare($sql_consumo);
                $consulta_consumo->bind_param("s", $cedula_usuario);
                $consulta_consumo->execute();
                $resultado_consumo = $consulta_consumo->get_result();

                // Mostrar los resultados en la tabla
                while ($fila_consumo = $resultado_consumo->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $fila_consumo['prestador']; ?></td>
                        <td><?php echo $fila_consumo['monto_autorizado']; ?></td>
                        <td><?php echo $fila_consumo['fecha']; ?></td>
                        <td><?php echo $fila_consumo['estado']; ?></td>
                        <td><?php echo $fila_consumo['tipo']; ?></td>
                    </tr>
                <?php endwhile;

                // Liberar recursos
                $consulta_consumo->close();
                ?>
            </tbody>
        </table>
    </main>

   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Datos de ejemplo para el gráfico
    const datosConsumo = {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
        datasets: [{
            label: 'Consumo de Medicamentos',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            data: [0, 0, 0, 180, 0, 0] // Aquí puedes colocar los datos reales de consumo
        }]
    };

    // Opciones del gráfico
    const opcionesGrafico = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    // Obtener el contexto del lienzo del gráfico
    const contexto = document.getElementById('graficoConsumo').getContext('2d');

    // Crear el gráfico de barras
    const graficoConsumo = new Chart(contexto, {
        type: 'bar',
        data: datosConsumo,
        options: opcionesGrafico
    });
</script>


    <script src="../js/scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script>
        // Función para ocultar el mensaje después de 3 segundos
        setTimeout(function() {
            document.getElementById('mensajeBienvenida').style.display = 'none';
        }, 3000);
    </script>
</body>
</html>
