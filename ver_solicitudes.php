<?php
session_start();
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
        body{
            margin-top: 100px;
        }
    </style>
</head>

<body>
<?php require_once('Datos/header.php'); ?>
<?php
require_once 'Datos/Conexion.php';

$id_cliente = 1; // puedes cambiar esto por $_SESSION["id_cliente"] si ya lo tienes en sesión

try {
    $conexion = Conexion::conectar();
    $sql = "SELECT solicitudes.id_solicitud, solicitudes.tiporutina, solicitudes.fecha_solicitud,
                   profesionales.nombre AS nombre_profesional, profesionales.apellidos AS apellidos_profesional
            FROM solicitudes
            JOIN profesionales ON solicitudes.id_profesional = profesionales.id_profesional
            WHERE solicitudes.id_cliente = :id_cliente
            ORDER BY solicitudes.fecha_solicitud DESC";

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
                </tr>
            </thead>
            <tbody>
            <?php foreach ($solicitudes as $solicitud): ?>
                <tr>
                    <td><?php echo htmlspecialchars($solicitud['id_solicitud']); ?></td>
                    <td><?php echo ucfirst(htmlspecialchars($solicitud['tiporutina'])); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['fecha_solicitud']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['nombre_profesional'] . ' ' . $solicitud['apellidos_profesional']); ?></td>
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