<?php
session_start();
require_once 'Datos/Conexion.php';

// Suponiendo que el id_cliente está guardado en la sesión
$id_cliente = 1; // O reemplaza con $_SESSION['id_cliente'];

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_profesional = $_POST['id_profesional'];
    $tipo_rutina = 'dieta'; // fija porque es solo para solicitar dieta

    try {
        $conexion = Conexion::conectar();
        $sql = "INSERT INTO solicitudes (id_Cliente, id_Profesional, TipoRutina)
                VALUES (:id_cliente, :id_profesional, :tipo_rutina)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':id_cliente' => $id_cliente,
            ':id_profesional' => $id_profesional,
            ':tipo_rutina' => $tipo_rutina
        ]);
        $mensaje = "Solicitud enviada correctamente.";
    } catch (Exception $e) {
        $mensaje = "Error al enviar la solicitud: " . $e->getMessage();
    } finally {
        Conexion::desconectar();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitar Dieta</title>
    <link rel="stylesheet" href="css/estilosMain.css">
    <style>
        form {
            margin: 40px;
        }
        label, select, input {
            display: block;
            margin-bottom: 15px;
        }
        input[type="submit"] {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php require_once('Datos/header.php'); ?>

<h2 style="margin-left: 40px;">Solicitar una Dieta</h2>

<?php
if ($mensaje) {
    echo "<p style='margin-left: 40px; color: green;'>$mensaje</p>";
}
?>

<form method="post" action="solicitar_dieta.php">
    <label for="id_profesional">Selecciona un Profesional:</label>
    <select name="id_profesional" id="id_profesional" required>
        <option value="">-- Elige --</option>
        <?php
        try {
            $conexion = Conexion::conectar();
            $sql = "SELECT id_Profesional, nombre, apellidos FROM Profesionales WHERE especialidad = 'Nutriologo'";
            $stmt = $conexion->query($sql);
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$fila['id_Profesional']}'>" . htmlspecialchars($fila['nombre']) . " " . htmlspecialchars($fila['apellidos']) . "</option>";
            }
        } catch (Exception $e) {
            echo "<option disabled>Error al cargar profesionales</option>";
        } finally {
            Conexion::desconectar();
        }
        ?>
    </select>

    <input type="submit" value="Enviar Solicitud">
</form>

</body>
</html>
