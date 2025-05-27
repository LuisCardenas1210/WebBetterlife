<?php
session_start();
include_once('Datos/DAOCliente.php');
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
            <thead>
                <th>Nombre</th> 
                <th>Apellidos</th>
                <th>Edad</th>
                <th>Genero</th>
                <th>Tipo de rutina</th>
                <th>Profesional</th>
            </thead>
            <tbody>
                <?php
                $lista=(new DAOCliente())->obtenerTodos();
                if($lista!=null){
                    foreach($lista as $Cliente){
                        echo"
                        <tr onclick=\"window.location='CrearRutina.php';\" class=\"Contenido\">
                            <td>$Cliente->nombreCliente</td>
                            <td>$Cliente->apellidos</td>
                            <td>$Cliente->edad</td>
                            <td>$Cliente->genero</td>
                            <td>$Cliente->tipoRutina</td>
                            <td>$Cliente->nombreProfesional</td>
                        </tr>
                        ";
                    }
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>