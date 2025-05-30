<?php
session_start();
require_once 'Datos/Conexion.php';
require_once 'Datos/header.php';

$id_cliente = $_SESSION["id_cliente"] ?? 1; 

$tipos_permitidos = ['dieta', 'ejercicio'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_profesional = $_POST["id_profesional"] ?? null;
    $tipo_rutina = $_POST["tiporutina"] ?? null;

    if ($id_profesional && $id_profesional != "0" && $tipo_rutina && in_array($tipo_rutina, $tipos_permitidos)) {
        try {
            $conexion = Conexion::conectar();
            $sql = "INSERT INTO solicitudes (id_cliente, id_profesional, tiporutina, fecha_solicitud)
                    VALUES (:id_cliente, :id_profesional, :tiporutina, NOW())";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                'id_cliente' => $id_cliente,
                'id_profesional' => $id_profesional,
                'tiporutina' => $tipo_rutina
            ]);
            $_SESSION['message'] = ['type' => 'success', 'text' => '✅ Solicitud enviada exitosamente.'];
        } catch (Exception $e) {
            $_SESSION['message'] = ['type' => 'error', 'text' => '❌ Error: ' . $e->getMessage()];
        } finally {
            Conexion::desconectar();
        }
    } else {
        $_SESSION['message'] = ['type' => 'error', 'text' => '❌ Por favor, selecciona un Profesional válido y un tipo de rutina correcto.'];
    }

    header("Location: solicitar_rutina.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitar Rutina</title>
    <link rel="stylesheet" href="css/estilosMain.css">
    <link rel="stylesheet" href="css/estilosVer_rutinas.css">
    <link rel="stylesheet" href="css/estilosSolicitar_dieta.css">
</head>

<body>

<?php
if (isset($_SESSION['message'])) {
    $msg = $_SESSION['message'];
    echo '<p class="message ' . ($msg['type'] === 'success' ? 'success' : 'error') . '">' . htmlspecialchars($msg['text']) . '</p>';
    unset($_SESSION['message']);
}
?>

<h2>Solicitar Rutina</h2>

<form method="POST" action="solicitar_rutina.php">
    <label for="id_profesional">Selecciona un Profesional:</label>
    <select name="id_profesional" id="id_profesional" required>
        <option value="0">-- Elige --</option>
        <?php
        try {
            $conexion = Conexion::conectar();
            $stmt = $conexion->prepare("SELECT id_profesional, nombre, apellidos FROM profesionales WHERE especialidad ILIKE 'Nutriologo' or especialidad ILIKE 'Entrenador' and status=TRUE");
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id = htmlspecialchars($row["id_profesional"]);
                $nombre = htmlspecialchars($row["nombre"]);
                $apellidos = htmlspecialchars($row["apellidos"]);
                echo "<option value=\"$id\">$nombre $apellidos</option>";
            }
        } catch (Exception $e) {
            echo "<option disabled>❌ Error al cargar profesionales</option>";
        } finally {
            Conexion::desconectar();
        }
        ?>
    </select>

    <label for="tiporutina">Selecciona el tipo de rutina:</label>
    <select name="tiporutina" id="tiporutina" required>
        <option value="">-- Elige tipo de rutina --</option>
        <option value="dieta">Dieta</option>
        <option value="ejercicio">Ejercicio</option>
    </select>

    <button type="submit" formnovalidate>Enviar Solicitud</button>
</form>

</body>
</html>
