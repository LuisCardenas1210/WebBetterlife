<?php
session_start();
include_once 'Datos/DAOCliente.php';
include_once 'Datos/DAOProfesional.php';

//recibe el metodo post del metodo para cambiar de estado el usuario
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cambiarEstado'], $_POST['tipoUsuario'])) {
    $id = $_POST['cambiarEstado'];
    $tipo = $_POST['tipoUsuario'];

    if ($tipo === 'cliente') {
        $dao = new DAOCliente();
        $cliente = $dao->obtenerClientePorId($id);
        $nuevoEstado = !$cliente->status;
        $dao->cambiarEstadoCliente($id, $nuevoEstado);
    } elseif ($tipo === 'profesional') {
        $dao = new DAOProfesional();
        $profesional = $dao->obtenerProfesionalPorId($id);
        $nuevoEstado = !$profesional->status;
        $dao->cambiarEstadoProfesional($id, $nuevoEstado);
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
    <link rel="stylesheet" href="css/estilosGestionarUsuarios.css">
</head>

<body>
    <?php
    require_once('Datos/header.php');
    ?>
    <main>
        <legend>Clientes</legend>
        <div class="usuarios">
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
                            $claseBoton = $accion === 'reactivar' ? 'boton-reactivar' : 'boton-suspender';
                            echo "
                        <tr>
                            <td>$Cliente->nombreCliente</td>
                            <td>$Cliente->apellidos</td>
                            <td>$Cliente->tipoUsuario</td>
                            <td>$Cliente->email</td>
                            <!--  <td>" . ($Cliente->status ? 'Activo' : 'Suspendido') . "</td> -->
                            <td>
                                <span class='" . ($Cliente->status ? 'estado-activo' : 'estado-suspendido') . "'>" .
                                    ($Cliente->status ? 'Activo' : 'Suspendido') .
                                "</span>
                            </td>

                            <td>
                                <button type='button' class='$claseBoton' onclick=\"abrirModalCliente('$Cliente->id_Cliente', '$accion')\">"
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
        </div>
        <legend>Profesionales</legend>
        <div class="usuarios">
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
                    $lista = (new DAOProfesional())->obtenerProfesionales();
                    if ($lista != null) {
                        foreach ($lista as $Profesional) {
                            $accion = $Profesional->status ? 'suspender' : 'reactivar';
                            $claseBoton = $accion === 'reactivar' ? 'boton-reactivar' : 'boton-suspender';
                            echo "
                        <tr>
                            <td>$Profesional->nombreProfesional</td>
                            <td>$Profesional->apellidos</td>
                            <td>$Profesional->tipoUsuario</td>
                            <td>$Profesional->email</td>
                            <!-- <td>" . ($Profesional->status ? 'Activo' : 'Suspendido') . "</td> -->
                            <td>
                                <span class='" . ($Profesional->status ? 'estado-activo' : 'estado-suspendido') . "'>" .
                                    ($Profesional->status ? 'Activo' : 'Suspendido') .
                                "</span>
                            </td>
                            <td>
                                <button type='button' class='$claseBoton' onclick=\"abrirModalProfesional('$Profesional->id_Profesional','$accion')\">"
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
        </div>
    </main>
    <!-- modal generico que si quieres puedes tomar prestado
     nomas le pones los parametros yo creo -->
    <div id="modalConfirmacionCliente" class="modal">
        <div class="modal-contenido">
            <p id="textoModalCliente">¿Estás seguro?</p>
            <form id="formularioModal" method="POST">
                <input type="hidden" name="tipoUsuario" value="cliente">
                <input type="hidden" name="cambiarEstado" id="clienteIdModal">
                <button type="submit">Sí</button>
                <button type="button" onclick="cerrarModalCliente()">Cancelar</button>
            </form>
        </div>
    </div>

    <div id="modalConfirmacionProfesional" class="modal">
        <div class="modal-contenido">
            <p id="textoModalProfesional">¿Estás seguro?</p>
            <form id="formularioModal" method="POST">
                <input type="hidden" name="tipoUsuario" value="profesional">
                <input type="hidden" name="cambiarEstado" id="profesionalIdModal">
                <button type="submit">Sí</button>
                <button type="button" onclick="cerrarModalProfesional()">Cancelar</button>
            </form>
        </div>
    </div>

    <script>
        function abrirModalCliente(idCliente, nombreAccion) {
            document.getElementById("clienteIdModal").value = idCliente;
            document.getElementById("textoModalCliente").innerText = `¿Deseas ${nombreAccion} al cliente?`;
            document.getElementById("modalConfirmacionCliente").style.display = "block";
        }

        function cerrarModalCliente() {
            document.getElementById("modalConfirmacionCliente").style.display = "none";
        }

        function abrirModalProfesional(idProfesional, nombreAccion) {
            document.getElementById("profesionalIdModal").value = idProfesional;
            document.getElementById("textoModalProfesional").innerText = `¿Deseas ${nombreAccion} al profesional?`;
            document.getElementById("modalConfirmacionProfesional").style.display = "block";
        }

        function cerrarModalProfesional() {
            document.getElementById("modalConfirmacionProfesional").style.display = "none";
        }

        // esto hace que se cierre el modal al dar un clik fuera
        window.onclick = function (event) {
            if (event.target === document.getElementById("modalConfirmacionCliente")) {
                cerrarModalCliente();
            }
            if (event.target === document.getElementById("modalConfirmacionProfesional")) {
                cerrarModalProfesional();
            }
        };
    </script>

</body>

</html>