<?php
session_start();
include_once 'Datos/DAOCliente.php';
include_once 'Datos/DAOProfesional.php';

if (!isset($_GET['id']) || !isset($_GET['tipo'])) {
    echo "Datos inválidos.";
    exit;
}



/* $id = $_GET['id'];
$dao = new DAOCliente();
$cliente = $dao->obtenerClientePorId($id);
 */

$id = $_GET['id'];
$tipo = $_GET['tipo'];

if ($tipo === 'cliente') {
    $dao = new DAOCliente();
    $usuario = $dao->obtenerClientePorId($id);
    $nombre = $usuario->nombreCliente;
    $correo = $usuario->email;
} elseif ($tipo === 'profesional') {
    $dao = new DAOProfesional();
    $usuario = $dao->obtenerProfesionalPorId($id);
    $nombre = $usuario->nombreProfesional;
    $correo = $usuario->email;
}
if (!$usuario) {
    echo ucfirst($tipo) . " no encontrado.";
    exit;
}


$id = $_GET['id'];
$tipo = $_GET['tipo'];

if ($tipo === 'cliente') {
    $dao = new DAOCliente();
    $usuario = $dao->obtenerClientePorId($id);
    $nombre = $usuario->nombreCliente;
    $correo = $usuario->email;
} elseif ($tipo === 'profesional') {
    $dao = new DAOProfesional();
    $usuario = $dao->obtenerProfesionalPorId($id);
    $nombre = $usuario->nombreProfesional;
    $correo = $usuario->email;
}



$error = null;
$mensaje = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nuevoCorreo = trim($_POST['email']);
    $nuevaContrasena = $_POST['contrasena'];
    $confirmarContrasena = $_POST['confirmar_contrasena'];

    
    if (!filter_var($nuevoCorreo, FILTER_VALIDATE_EMAIL)) {
        $error = "Correo inválido.";
    } elseif (strlen($nuevaContrasena) < 4) {
        $error = "La contraseña debe tener al menos 4 caracteres.";
    } elseif ($nuevaContrasena !== $confirmarContrasena) {
        $error = "Las contraseñas no coinciden.";
    } else {
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
        <section class="usuarios">
            <legend>Cambiar credenciales de <?= htmlspecialchars($nombre) ?></legend>

            <?php if ($mensaje): ?>
                <p style="color: green;"><?= htmlspecialchars($mensaje) ?></p>
            <?php endif; ?>

            <?php if ($error): ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form method="POST" autocomplete="off" style="display: flex; flex-direction: column; align-items: center;">
                <label for="email">Correo:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($correo) ?>" required style="width: 250px; padding: 5px;"><br>

                <label for="contrasena">Contraseña nueva:</label>
                <input type="password" id="contrasena" name="contrasena" required style="width: 250px; padding: 5px;"><br>

                <label for="confirmar_contrasena">Confirmar contraseña:</label>
                <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required style="width: 250px; padding: 5px;"><br>


                <div style="display: flex; gap: 10px; margin-top: 10px;">
                    <button type="submit" class="boton-primario">Guardar</button>
                    <button type="button" class="boton-secundario" onclick="window.location.href='GestionUsuarios.php'">Volver</button>
                </div>
            </form>

        </section>
    </main>
    <script src="Scripts/validarCambiarCredenciales.js"></script>
</body>
</html>
