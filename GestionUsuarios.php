<?php
session_start();
include_once 'Datos/DAOUsuario.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['eliminarCliente'])) {
    $id = intval($_POST['eliminarCliente']);
    (new DAOUsuario())->eliminarCliente($id);
    //header("Location: GestionUsuarios.php"); // Redirige para evitar reenvío de formulario
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
                $lista = (new DAOUsuario())->obtenerClientes();
                if ($lista != null) {
                    foreach ($lista as $Cliente) {
                        echo "
                        <tr>
                            <td>$Cliente->nombre</td>
                            <td>$Cliente->apellidos</td>
                            <td>$Cliente->tipoUsuario</td>
                            <td>$Cliente->correoE</td>
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
                $lista = (new DAOUsuario())->obtenerProfesionales();
                if ($lista != null) {
                    foreach ($lista as $Cliente) {
                        echo "
                        <tr>
                            <td>$Cliente->nombre</td>
                            <td>$Cliente->apellidos</td>
                            <td>$Cliente->tipoUsuario</td>
                            <td>$Cliente->correoE</td>
                            <td></td>
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