<?php
session_start();

if (!isset($_SESSION["tipoUsuario"])) {
    echo "<p style='color:red; text-align:center;'>No ha iniciado sesión.</p>";
    exit;
}

$tipoUsuario = $_SESSION["tipoUsuario"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitudes Realizadas</title>
    <link rel="stylesheet" href="css/estilosMain.css">
    <link rel="stylesheet" href="css/estilosVer_rutinas.css">
    <style>
        table {
            margin: 50px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 5px 10px;
        }
        h2, p {
            text-align: center;
        }
    </style>
</head>

<body>
<?php require_once('Datos/header.php'); ?>

<?php
require_once 'Datos/Conexion.php';

// Usa el ID del cliente de la sesión si existe, si no, usa uno fijo (modo prueba)
$id_cliente = isset($_SESSION["id_cliente"]) ? $_SESSION["id_cliente"] : 1;

try {
    $conexion = Conexion::conectar();

    $sql = "SELECT 
                solicitudes.id_solicitud, 
                solicitudes.tiporutina, 
                solicitudes.fecha_solicitud,
                profesionales.nombre AS nombre_profesional, 
                profesionales.apellidos AS apellidos_profesional,
                clientes.nombre AS nombre_cliente,
                clientes.apellidos AS apellidos_cliente
            FROM solicitudes
            JOIN profesionales ON solicitudes.id_profesional = profesionales.id_profesional
            JOIN clientes ON solicitudes.id_cliente = clientes.id_cliente
            WHERE solicitudes.id_cliente = :id_cliente";

    // Filtrado según tipoUsuario
    if ($tipoUsuario === 'entrenador') {
        $sql .= " AND solicitudes.tiporutina = 'ejercicio'";
    } elseif ($tipoUsuario === 'nutriologo') {
        $sql .= " AND solicitudes.tiporutina = 'dieta'";
    }

    $sql .= " ORDER BY solicitudes.fecha_solicitud DESC";

    $stmt = $conexion->prepare($sql);
    $stmt->execute(['id_cliente' => $id_cliente]);

    $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($solicitudes):
        ?>
        <h2>Solicitudes Realizadas</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Solicitud</th>
                    <th>Tipo de Rutina</th>
                    <th>Fecha de Solicitud</th>
                    <th>Profesional Asignado</th>
                    <th>Cliente</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($solicitudes as $solicitud): ?>
                <tr>
                    <td><?= htmlspecialchars($solicitud['id_solicitud']) ?></td>
                    <td><?= ucfirst(htmlspecialchars($solicitud['tiporutina'])) ?></td>
                    <td><?= htmlspecialchars($solicitud['fecha_solicitud']) ?></td>
                    <td><?= htmlspecialchars($solicitud['nombre_profesional'] . ' ' . $solicitud['apellidos_profesional']) ?></td>
                    <td><?= htmlspecialchars($solicitud['nombre_cliente'] . ' ' . $solicitud['apellidos_cliente']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php
    else:
        echo "<p>No se encontró ninguna solicitud para este cliente.</p>";
    endif;

} catch (Exception $e) {
    echo "<p style='color: red; text-align: center;'>Error al obtener las solicitudes: " . $e->getMessage() . "</p>";
} finally {
    Conexion::desconectar();
}
?>

</body>
</html>
