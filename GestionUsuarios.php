<?php
session_start();
include_once 'Datos/DAOCliente.php';
include_once 'Datos/DAOProfesional.php';

//recibe el metodo post del metodo para cambiar de estado el usuario
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    if (isset($_POST['cambiarEstado'])) {
        $dao = new DAOCliente();
        $clienteId = $_POST['cambiarEstado'];
        $cliente = $dao->obtenerClientePorId($clienteId);
        $nuevoEstado = !$cliente->status;
        $dao->cambiarEstadoCliente($clienteId, $nuevoEstado);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    if (isset($_POST['cambiarEstado'])) {
        $dao = new DAOProfesional();
        $profesionalId = $_POST['cambiarEstado'];
        $profesional = $dao->obtenerProfesionalPorId($clienteId);
        $nuevoEstado = !$profesional->status;
        $dao->cambiarEstadoProfesional($clienteId, $nuevoEstado);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilosMain.css">
    <link rel="stylesheet" href="css/modal.css">
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
                <th>Status</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php
                $lista = (new DAOCliente())->obtenerClientes();
                if ($lista != null) {
                    foreach ($lista as $Cliente) {
                        $accion = $Cliente->status ? 'suspender' : 'reactivar';
                        echo "
                        <tr>
                            <td>$Cliente->nombreCliente</td>
                            <td>$Cliente->apellidos</td>
                            <td>$Cliente->tipoUsuario</td>
                            <td>$Cliente->email</td>
                            <td>" . ($Cliente->status ? 'Activo' : 'Suspendido') . "</td>
                            <td>
                                <button type='button' onclick=\"abrirModal('$Cliente->id_Cliente',
                                '$accion')\">"
                                    . ucfirst($accion) .
                                "</button>
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
                        $accion = $Profesional->status ? 'suspender' : 'reactivar';
                        echo "
                        <tr>
                            <td>$Profesional->nombreProfesional</td>
                            <td>$Profesional->apellidos</td>
                            <td>$Profesional->tipoUsuario</td>
                            <td>$Profesional->email</td>
                            <td>" . ($Profesional->status ? 'Activo' : 'Suspendido') . "</td>
                            <td>
                                <button type='button' onclick=\"abrirModal('$Profesional->id_Profesional',
                                '$accion')\">"
                                    . ucfirst($accion) .
                                "</button>
                            </td>
                        </tr>
                        ";
                    }
                }
                ?>
            </tbody>
        </table>
    </main>
    <!-- modal generico que si quieres puedes tomar prestado
     nomas le pones los parametros yo creo -->
    <div id="modalConfirmacion" class="modal">
    <div class="modal-contenido">
        <p id="textoModal">¿Estás seguro?</p>
        <form id="formularioModal" method="POST">
        <input type="hidden" name="cambiarEstado" id="clienteIdModal">
        <button type="submit">Sí</button>
        <button type="button" onclick="cerrarModal()">Cancelar</button>
        </form>
    </div>
    </div>
    <script>
        function abrirModal(idCliente, nombreAccion) {
            document.getElementById("clienteIdModal").value = idCliente;
            document.getElementById("textoModal").innerText = `¿Deseas ${nombreAccion} al cliente?`;
            document.getElementById("modalConfirmacion").style.display = "block";
        }

        function cerrarModal() {
            document.getElementById("modalConfirmacion").style.display = "none";
        }
        // esto hace que se cierre el modal al dar un clik fuera
        window.onclick = function(event) {
            const modal = document.getElementById("modalConfirmacion");
            if (event.target === modal) {
            cerrarModal();
            }
        };
    </script>


</body>

</html>