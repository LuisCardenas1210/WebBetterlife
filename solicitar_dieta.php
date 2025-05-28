<?php
session_start();
require_once 'Datos/Conexion.php';
require_once 'Datos/header.php';

$id_cliente = $_SESSION["id_cliente"] ?? 1; // por defecto 1 si no está en sesión

// Lista permitida de tipos de rutina
$tipos_permitidos = ['dieta', 'ejercicio'];

// Procesar POST
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

    // Redirigir para evitar reenvío del formulario al refrescar
    header("Location: solicitar_dieta.php");
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
    <style>
        /* Aquí mantienes tus estilos actuales */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 50px;
        }
        form {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px;
            box-sizing: border-box;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-weight: 700;
            font-size: 1.8rem;
        }
        label {
            font-weight: 600;
            color: #444;
            margin-bottom: 8px;
            display: block;
            font-size: 1rem;
        }
        select {
            width: 100%;
            padding: 10px 14px;
            font-size: 1rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            transition: border-color 0.3s ease;
            margin-bottom: 25px;
            background: #fafafa;
            cursor: pointer;
        }
        select:focus {
            border-color: #008CBA;
            outline: none;
            background: #fff;
        }
        button {
            width: 100%;
            padding: 12px;
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            background-color: #008CBA;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,140,186,0.4);
        }
        button:hover {
            background-color: #007B9E;
            box-shadow: 0 6px 14px rgba(0,123,158,0.6);
        }
        /* Mensajes */
        .message {
            max-width: 450px;
            margin: 20px auto 0;
            padding: 15px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            text-align: center;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        body{
            margin-top: 100px;
        }
    </style>
</head>
<body>

<?php
// Mostrar mensaje si existe y luego eliminarlo para que no se repita
if (isset($_SESSION['message'])) {
    $msg = $_SESSION['message'];
    echo '<p class="message ' . ($msg['type'] === 'success' ? 'success' : 'error') . '">' . htmlspecialchars($msg['text']) . '</p>';
    unset($_SESSION['message']);
}
?>

<h2>Solicitar Rutina</h2>

<form method="POST" action="solicitar_dieta.php">
    <label for="id_profesional">Selecciona un Profesional:</label>
    <select name="id_profesional" id="id_profesional" required>
        <option value="0">-- Elige --</option>
        <?php
        try {
            $conexion = Conexion::conectar();
            $stmt = $conexion->prepare("SELECT id_profesional, nombre, apellidos FROM profesionales WHERE especialidad ILIKE 'Nutriologo' or especialidad ILIKE 'Entrenador'");
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

    <button type="submit">Enviar Solicitud</button>
</form>

</body>
</html>
