<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Iniciar Sesión - BetterLife</title>
    <link rel="stylesheet" href="css/estilosregistro.css" />
    <script src="js/validacionLogin.js" defer></script>
</head>

<body>
    <?php
    include_once 'Datos/DAOUsuario.php';

    $errores = [];

    if (!empty($_POST)) {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        // Validación de servidor
        if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "Por favor, ingrese un correo válido.";
        }

        if (strlen($password) < 4) {
            $errores[] = "La contraseña debe tener al menos 4 caracteres.";
        }

        if (empty($errores)) {
            $usuario = (new DAOUsuario())->autenticar($email, $password);

            if ($usuario != null && $usuario->status == 1) {
                session_start();

                // Guardar nombre, apellidos y tipo de usuario
                $_SESSION["nombre"] = $usuario->nombre;
                $_SESSION["apellidos"] = $usuario->apellidos;
                $_SESSION["tipoUsuario"] = $usuario->tipoUsuario;

                // Guardar ID dependiendo del tipo de usuario
                if ($usuario->tipoUsuario === 'cliente') {
                    $_SESSION["id_cliente"] = $usuario->id_Cliente;
                } else {
                    $_SESSION["id_profesional"] = $usuario->id_Profesional;
                }

                header("Location: index.php");
                exit;
            } else {
                $errores[] = "Usuario y/o contraseña incorrectos";
            }
        }
    }
    ?>

    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form method="post" novalidate>
            <div class="input-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required autocomplete="off"
                    value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" />
            </div>
            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required
                    value="<?= isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>" />
            </div>
            <?php if (!empty($errores)) : ?>
                <div id="errores" style="color: red;">
                    <?php foreach ($errores as $error) : ?>
                        <div><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div id="errores" style="display: none;"></div>
            <?php endif; ?>
            <button type="submit">Ingresar</button>
        </form>
        <p>¿No tienes una cuenta? <a href="registrar.php">Regístrate aquí</a></p>
    </div>

    <script src="js/validacionLogin.js"></script>
</body>

</html>
