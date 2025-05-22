<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - BetterLife</title>
    <link rel="stylesheet" href="css/estilosregistro.css">
    <script src="js/validacionLogin.js" defer></script>
</head>
<body>
<?php
include_once 'Controller/CargarUsuario.php';
/* echo "<pre>";
var_dump($Lista_usuarios);
echo "</pre>"; */

if (!empty($_POST)) {
    if (isset($_POST["email"], $_POST["password"])) {
        $email = trim(strtolower($_POST["email"]));
        $password = trim($_POST["password"]);

        foreach ($Lista_usuarios as $usuario) {
            if (strtolower($usuario->correoE) === $email && $usuario->contrasenia === $password) {
                session_start();
                $_SESSION["nombre"] = $usuario->nombre;
                $_SESSION["email"] = $usuario->correoE;
                header("Location: index.php");
                exit();
            }
        }

        echo "<script>alert('Correo o contraseña incorrectos.');</script>";
    }
}
?>
<div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form method="post">
        <div class="input-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required autocomplete="off"
                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
        </div>
        <div class="input-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required
                value="<?= isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>">
        </div>
        <button type="submit" formnovalidate>Ingresar</button>
    </form>
    <p>¿No tienes una cuenta? <a href="registrar.html">Regístrate aquí</a></p>
    <script src="Scripts/validacionLogin.js"></script>
</div>
</body>
</html>
