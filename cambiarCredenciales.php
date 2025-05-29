<?php
session_start();
include_once 'Datos/DAOCliente.php';

// Validar parámetros de entrada
if (!isset($_GET['id']) || !isset($_GET['tipo']) || $_GET['tipo'] !== 'cliente') {
    echo "Datos inválidos.";
    exit;
}

$id = $_GET['id'];
$dao = new DAOCliente();
$cliente = $dao->obtenerClientePorId($id);

if (!$cliente) {
    echo "Cliente no encontrado.";
    exit;
}

$error = null;
$mensaje = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nuevoCorreo = trim($_POST['email']);
    $nuevaContrasena = $_POST['contrasena'];

    // Validaciones
    if (!filter_var($nuevoCorreo, FILTER_VALIDATE_EMAIL)) {
        $error = "Correo inválido.";
    } elseif (strlen($nuevaContrasena) < 4) {
        $error = "La contraseña debe tener al menos 4 caracteres.";
    } else {
        $resultado = $dao->actualizarCorreoYContrasena($id, $nuevoCorreo, $nuevaContrasena);

        if ($dao->actualizarCorreoYContrasena($id, $nuevoCorreo, $nuevaContrasena)) {
            $mensaje = "Credenciales actualizadas correctamente.";
        } else {
            $error = "Error al actualizar las credenciales.";
        }

    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar Credenciales</title>
    <link rel="stylesheet" href="css/estilosMain.css">
</head>


<body>
        <?php require_once('Datos/header.php'); ?>
    <main>        
    <h2>Cambiar correo y contraseña de <?= htmlspecialchars($cliente->nombreCliente) ?></h2>

    <?php if ($mensaje): ?>
        <p style="color: green;"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="email">Correo:</label><br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($cliente->email) ?>" required><br><br>

        <label for="contrasena">Contraseña nueva:</label><br>
        <input type="password" id="contrasena" name="contrasena" required><br><br>

        <button type="submit">Guardar cambios</button>
        <a href="gestionarUsuarios.php">Cancelar</a>
    </form>
    </main>
</body>
</html>
