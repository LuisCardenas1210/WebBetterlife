<?php
session_start();
require_once 'Datos/Conexion.php';

if (!isset($_SESSION['tipoUsuario']) || trim($_SESSION['tipoUsuario']) !== 'profesional') {
    header("Location: index.php");
    exit();
}

try {
    $pdo = Conexion::conectar();

    $sql = "SELECT u.id_usuario, u.nombre, u.correoE, s.objetivo, s.fecha_solicitud
            FROM solicitudes s
            JOIN usuarios u ON s.usuario_id = u.id_usuario
            ORDER BY s.fecha_solicitud DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener solicitudes: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitudes de Rutina</title>
    <link rel="stylesheet" href="css/estilosSolicitudes.css">
</head>
<body>
    <h1>Solicitudes de Rutina</h1>
    <table border="1">
        <tr>
            <th>Usuario</th>
            <th>Email</th>
            <th>Objetivo</th>
            <th>Fecha</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($solicitudes as $s): ?>
            <tr>
                <td><?= htmlspecialchars($s['nombre']) ?></td>
                <td><?= htmlspecialchars($s['correoE']) ?></td>
                <td><?= htmlspecialchars($s['objetivo']) ?></td>
                <td><?= htmlspecialchars($s['fecha_solicitud']) ?></td>
                <td><a href="CrearRutina.php?usuario_id=<?= $s['id_usuario'] ?>">Crear Rutina</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
