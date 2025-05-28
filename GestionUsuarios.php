<?php
session_start();
include_once 'Datos/DAOCliente.php';
include_once 'Datos/DAOProfesional.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['eliminarCliente'])) {
    $id = intval($_POST['eliminarCliente']);
    (new DAOCliente())->eliminarCliente($id);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['eliminarProfesional'])) {
    $id = intval($_POST['eliminarProfesional']);
    (new DAOProfesional())->eliminarProfesional($id);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilosMain.css">
</head>

<body>
    <?php
    require_once('Datos/header.php');
    ?>
    <main>
        <legend>Clientes</legend>
        <table border="1">
            <thead>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Tipo de usuario</th>
                <th>Correo</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php
                $lista = (new DAOCliente())->obtenerClientes();
                if ($lista != null) {
                    foreach ($lista as $Cliente) {
                        echo "
                        <tr>
                            <td>$Cliente->nombreCliente</td>
                            <td>$Cliente->apellidos</td>
                            <td>$Cliente->tipoUsuario</td>
                            <td>$Cliente->email</td>
                            <td>
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='eliminarCliente' value='" . $Cliente->id_Cliente . "'>
                                <button type='submit' onclick=\"return confirm('¿Eliminar cliente?');\">Eliminar</button>
                            </form>
                            </td>
                        </tr>
                        ";
                    }
                }
                ?>
            </tbody>
        </table>

        <legend>Profesionales</legend>
        <table border="1">
            <thead>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Tipo de usuario</th>
                <th>Correo</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php
                $lista = (new DAOProfesional())->obtenerProfesionales();
                if ($lista != null) {
                    foreach ($lista as $Profesional) {
                        echo "
                        <tr>
                            <td>$Profesional->nombreProfesional</td>
                            <td>$Profesional->apellidos</td>
                            <td>$Profesional->tipoUsuario</td>
                            <td>$Profesional->email</td>
                            <td>
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='eliminarProfesional' value='" . $Profesional->id_Profesional . "'>
                                <button type='submit' onclick=\"return confirm('¿Eliminar Profesional?');\">Eliminar</button>
                            </form>
                            </td>
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