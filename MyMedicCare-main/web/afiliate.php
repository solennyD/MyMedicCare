<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Afíliate - Medic Care</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../img/imag.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
    <style>
        /* Tus estilos CSS aquí */
    </style>
</head>
<body>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Plan Basico</h2>
            <h3 class="panel-title">Afíliate</h3>
        </div>
        <div class="panel-body">
            <form action="procesar_afiliacion.php" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>
                <div class="form-group">
                    <label for="asunto">Asunto:</label>
                    <input type="text" class="form-control" id="asunto" name="asunto" required>
                </div>
                <div class="form-group">
                    <label for="tipo_cliente">Tipo de Cliente:</label>
                    <select class="form-control" id="tipo_cliente" name="tipo_cliente" required>
                        <option value="individual">Individual</option>
                        <option value="familiar">Familiar</option>
                        <option value="empresarial">Empresarial</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cedula">Cédula / Pasaporte / RNC:</label>
                    <input type="text" class="form-control" id="cedula" name="cedula" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>
                <div class="form-group">
                    <label for="sucursal">Sucursal:</label>
                    <input type="text" class="form-control" id="sucursal" name="sucursal">
                </div>
                <!-- Aquí podrías añadir el captcha si lo deseas -->
                <button type="submit" class="btn btn-primary">Solicitar</button>
            </form>
        </div>
    </div>
</div>

<!-- Resto de tu código aquí -->

</body>
</html>
