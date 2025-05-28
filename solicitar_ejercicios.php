<?php
session_start();
require_once 'Datos/Conexion.php';
require_once 'Datos/header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitar Ejercicio</title>
    <link rel="stylesheet" href="css/estilosMain.css">
    <link rel="stylesheet" href="css/estilosVer_rutinas.css">
    <style>
        form {
            margin: 50px 20px;
        }
        label, select, button {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }
        button {
            padding: 6px 12px;
            background-color: #008CBA;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #007B9E;
        }
        body{
            margin-top: 100px;
        }
    </style>
</head>
<body>

<?php
$id_cliente = $_SESSION["id_cliente"] ?? 1; // por defecto 1 si no está en sesión

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_profesional = $_POST["id_profesional"] ?? null;

    if ($id_profesional && $id_profesional != "0") {
        try {
            $conexion = Conexion::conectar();
            $sql = "INSERT INTO solicitudes (id_cliente, id_profesional, tiporutina, fecha_solicitud)
                    VALUES (:id_cliente, :id_profesional, 'ejercicio', NOW())";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                'id_cliente' => $id_cliente,
                'id_profesional' => $id_profesional
            ]);
            echo "<p style='color: green; margin-left: 20px;'>✅ Solicitud enviada exitosamente.</p>";
        } catch (Exception $e) {
            echo "<p style='color: red; margin-left: 20px;'>❌ Error: " . $e->getMessage() . "</p>";
        } finally {
            Conexion::desconectar();
        }
    } else {
        echo "<p style='color: red; margin-left: 20px;'>❌ Por favor, selecciona un entrenador válido.</p>";
    }
}
?>

<h2 style="margin-left: 20px;">Solicitar Rutina de Ejercicio</h2>

<form method="POST" action="solicitar_ejercicios.php">
    <label for="id_profesional"><strong>Selecciona un Entrenador:</strong></label>
<select name="id_profesional" id="id_profesional" required>
    <option value="0">-- Elige --</option>
    <?php
    try {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT id_profesional, nombre, apellidos FROM profesionales WHERE especialidad ILIKE 'Entrenador'");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = htmlspecialchars($row["id_profesional"]);
            $nombre = htmlspecialchars($row["nombre"]);
            $apellidos = htmlspecialchars($row["apellidos"]);
            echo "<option value=\"$id\">$nombre $apellidos</option>";
        }
    } catch (Exception $e) {
        echo "<option disabled>❌ Error al cargar entrenadores</option>";
    } finally {
        Conexion::desconectar();
    }
    ?>
</select>

    </select>
    <button type="submit">Enviar Solicitud</button>
</form>



</body>
</html>
