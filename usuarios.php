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
    <style>
        .boton-crear-rutina {
            padding: 5px 10px;
            background-color: #28a745; /* verde */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .boton-crear-rutina:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <?php
    require_once('Datos/header.php');
    ?>
    <main>
        <div id="tabla">
            <table border="1">
                <thead>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Edad</th>
                    <th>Género</th>
                    <th>Tipo de rutina</th>
                    <th>Profesional</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <?php
                    $lista = (new DAOCliente())->obtenerTodos();
                    if ($lista != null) {
                        foreach ($lista as $Cliente) {
                            echo "
                            <tr>
                                <td>$Cliente->nombreCliente</td>
                                <td>$Cliente->apellidos</td>
                                <td>$Cliente->edad</td>
                                <td>$Cliente->genero</td>
                                <td>$Cliente->tipoRutina</td>
                                <td>$Cliente->nombreProfesional</td>
                                <td>
                                    <form method='POST' action='CrearRutina.php'>
                                        <input type='hidden' name='id_Usuario' value='$Cliente->id_Cliente'>
                                        <input type='hidden' name='id_Solicitud' value='$Cliente->id_Solicitud'>
                                        <button type='submit' class='boton-crear-rutina'>Crear Rutina</button>
                                    </form>
                                </td>
                            </tr>
                            ";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>
