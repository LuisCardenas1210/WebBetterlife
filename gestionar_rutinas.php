<?php
session_start();
require_once 'Datos/Conexion.php';
require_once 'Datos/DAORutina.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_rutina'])) {
    $id_rutina = $_POST['id_rutina'];

    try {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("DELETE FROM rutinas WHERE id_rutina = :id");
        $stmt->execute([':id' => $id_rutina]);
        $mensaje = "Rutina eliminada correctamente.";
    } catch (Exception $e) {
        $mensaje = "Error al eliminar la rutina.";
    } finally {
        Conexion::desconectar();
    }
}

try {
    $conexion = Conexion::conectar();
    $sql = "SELECT r.*, c.nombre AS cliente, p.nombre AS profesional
            FROM rutinas r
            JOIN clientes c ON r.id_cliente = c.id_cliente
            JOIN profesionales p ON r.id_profesional = p.id_profesional
            ORDER BY r.id_rutina DESC";

    $stmt = $conexion->query($sql);
    $rutinas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $rutinas = [];
    $mensaje = "Error al obtener las rutinas: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Rutinas</title>
    <link rel="stylesheet" href="css/estilosMain.css">
    <link rel="stylesheet" href="css/estilosVer_rutinas.css">
</head>
<body>
<?php require_once('Datos/header.php'); ?>

<h2>Gestión de Rutinas</h2>

<?php if (isset($mensaje)): ?>
    <p class="mensaje"><?php echo htmlspecialchars($mensaje); ?></p>
<?php endif; ?>

<?php if ($rutinas): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Profesional</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
                <th>Sábado</th>
                <th>Domingo</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($rutinas as $rutina): ?>
            <tr>
                <td><?php echo $rutina['id_rutina']; ?></td>
                <td><?php echo htmlspecialchars($rutina['cliente']); ?></td>
                <td><?php echo htmlspecialchars($rutina['profesional']); ?></td>
                <td><?php echo htmlspecialchars($rutina['tiporutina']); ?></td>
                <td><?php echo htmlspecialchars($rutina['descripcionrutina']); ?></td>
                <td><?php echo htmlspecialchars($rutina['lunes']); ?></td>
                <td><?php echo htmlspecialchars($rutina['martes']); ?></td>
                <td><?php echo htmlspecialchars($rutina['miercoles']); ?></td>
                <td><?php echo htmlspecialchars($rutina['jueves']); ?></td>
                <td><?php echo htmlspecialchars($rutina['viernes']); ?></td>
                <td><?php echo htmlspecialchars($rutina['sabado']); ?></td>
                <td><?php echo htmlspecialchars($rutina['domingo']); ?></td>

                <td>
                    <form method="post" action="" class="form-eliminar">
                        <input type="hidden" name="id_rutina" value="<?php echo $rutina['id_rutina']; ?>">
                        <button type="button" onclick="mostrarModal(this)">Eliminar</button>
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p class="mensaje">No hay rutinas registradas.</p>
    <?php endif; ?>


    <div id="modalConfirmacion" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
        <div style="background:white; padding:20px; border-radius:10px; max-width:300px; text-align:center;">
            <p>¿Seguro que deseas eliminar esta rutina?</p>
            <button onclick="confirmarEliminar()">Sí, eliminar</button>
            <button onclick="cerrarModal()">Cancelar</button>
        </div>
    </div>

    <script>
        let formularioActual = null;

        function mostrarModal(boton) {
            formularioActual = boton.closest('form');
            document.getElementById('modalConfirmacion').style.display = 'flex';
        }

        function cerrarModal() {
            document.getElementById('modalConfirmacion').style.display = 'none';
            formularioActual = null;
        }

        function confirmarEliminar() {
            if (formularioActual) {
                formularioActual.submit();
            }
        }
    </script>

</body>
</html>
