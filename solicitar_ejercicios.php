<?php
session_start();
require_once 'Datos/Conexion.php';

if (!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] !== 'cliente') {
    header("Location: index.php");
    exit();
}

try {
    $pdo = Conexion::conectar();

    $stmt = $pdo->query("SELECT id_Profesional, nombre FROM Profesionales");
    $profesionales = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id_cliente = $_SESSION['id_cliente'];
        $id_profesional = $_POST['id_profesional'];

        $sql = "INSERT INTO solicitudes (id_Cliente, id_Profesional, TipoRutina)
                VALUES (:id_cliente, :id_profesional, 'Ejercicio')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id_cliente' => $id_cliente,
            ':id_profesional' => $id_profesional
        ]);

        echo "<p>Solicitud enviada con éxito.</p>";
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitar Ejercicios</title>
</head>
<body>
    <h1>Solicitar Ejercicios</h1>
    <form method="POST">
        <label for="id_profesional">Selecciona un profesional:</label>
        <select name="id_profesional" required>
            <?php foreach ($profesionales as $pro): ?>
                <option value="<?= $pro['id_Profesional'] ?>"><?= htmlspecialchars($pro['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Enviar Solicitud</button>
    </form>
</body>
</html>
