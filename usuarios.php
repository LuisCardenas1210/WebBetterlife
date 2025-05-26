<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetterLife</title>
    <link rel="stylesheet" href="css/estilosMain.css">
    <link rel="stylesheet" href="css/estilosUsuarios.css">
</head>
<body>
    <?php
    require_once('Datos/header.php');
    ?>
    <main>
        <table border="1">
            <tr class="Titulo kanit">
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Edad</th>
                <th>Genero</th>
            </tr>
            <tr onclick="window.location='CrearRutina.php';" class="Contenido">
                <td>Luis Manuel</th>
                <td>Cárdenas Ibarra</th>
                <td>20</th>
                <td>Hombre</th>
            </tr>
            <tr onclick="window.location='CrearRutina.php';" class="Contenido">
                <td>Alejandro</th>
                <td>Lezama Torres</th>
                <td>20</th>
                <td>Hombre</th>
            </tr>
            <tr onclick="window.location='CrearRutina.php';" class="Contenido">
                <td>Jovanny</th>
                <td>Lobato García</th>
                <td>21</th>
                <td>Hombre</th>
            </tr>
            <tr onclick="window.location='CrearRutina.php';" class="Contenido">
                <td>Manuel</th>
                <td>Cano Zavala</th>
                <td>20</th>
                <td>Hombre</th>
            </tr>
        </table>
    </main>
</body>
</html>