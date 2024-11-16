<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cita Existente</title>
    <style>
        .container {
            margin: 50px auto;
            width: 80%;
            text-align: center;
        }
        .alert {
            padding: 20px;
            color: black;
            font-weight: bold;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .alert-info {
            background-color: #5bc0de; /* Azul */
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #337ab7;  
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #286090;  
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
         
        $cedula = $_GET['cedula'];
        ?>
        <div class="alert alert-info">
            <p>Ya existe una cita agendada para la cédula: <?php echo $cedula; ?></p>
        </div>
        <p>
            <a href="index.php" class="btn">Volver al inicio</a>
            <a href="cita_agendada.php?cedula=<?php echo $cedula; ?>" class="btn">Ver Cita</a>
        </p>
    </div>
</body>
</html>
