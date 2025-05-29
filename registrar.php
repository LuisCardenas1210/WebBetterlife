<?php
session_start();
require_once 'Datos/DAOCliente.php';
require_once 'Datos/DAOProfesional.php';
require_once 'Modelos/Cliente.php';
require_once 'Modelos/Profesional.php';
$errores = [];
$mensaje = "";
$tipo = $_POST['tipoUsuario'] ?? '';

function validarMedida($valor)
{
    return preg_match('/^\d+(kg|cm)$/i', $valor);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['tipoUsuario'];
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $correo = trim($_POST['correo']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (strlen($nombre) < 2)
        $errores[] = "El nombre debe tener al menos 2 caracteres.";
    if (strlen($apellidos) < 2)
        $errores[] = "Los apellidos deben tener al menos 2 caracteres.";
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL))
        $errores[] = "Correo electrónico no válido.";
    if (strlen($password) < 4)
        $errores[] = "La contraseña debe tener al menos 4 caracteres.";
    if ($password !== $confirm_password)
        $errores[] = "Las contraseñas no coinciden.";

    if ($tipo === 'cliente') {
        $edad = intval($_POST['txtEdad']);
        $peso = $_POST['txtPeso'];
        $estatura = $_POST['txtEstatura'];
        $brazoC = $_POST['txtBrazoC'];
        $brazoR = $_POST['txtBrazoR'];
        $cintura = $_POST['txtCintura'];
        $pierna = $_POST['txtPierna'];
        $sexo = $_POST['sexo'];
        $preferencia = $_POST['preferencia'];

        if ($edad <= 0)
            $errores[] = "Edad no válida.";
        foreach (['Peso' => $peso, 'Estatura' => $estatura, 'Brazo Contraído' => $brazoC, 'Brazo Relajado' => $brazoR, 'Cintura' => $cintura, 'Pierna' => $pierna] as $campo => $valor) {
            if (!validarMedida($valor)) {
                $errores[] = "El campo $campo debe tener formato válido (ej: 70kg, 170cm).";
            }
        }
        if (empty($sexo))
            $errores[] = "Seleccione un sexo.";
        if (empty($preferencia))
            $errores[] = "Seleccione una preferencia.";
    } else {
        $especialidad = trim($_POST['txtEspecialidad']);
        $enfoque = trim($_POST['txtEnfoque']);
        $eslogan = trim($_POST['txtEslogan']);

        if (strlen($especialidad) < 3)
            $errores[] = "La especialidad debe tener al menos 3 caracteres.";
        if (strlen($enfoque) < 5)
            $errores[] = "El enfoque debe tener al menos 5 caracteres.";
    }

    if (empty($errores)) {
        $mensaje = $tipo === 'cliente'
            ? "Cliente registrado correctamente."
            : "Profesional registrado correctamente.";
        if ($tipo === 'cliente') {
            $cliente = new Cliente();
            $cliente->nombreCliente = $nombre;
            $cliente->apellidos = $apellidos;
            $cliente->email = $correo;
            $cliente->contrasenia = $password;
            $cliente->edad = $edad;
            $cliente->peso = $peso;
            $cliente->estatura = $estatura;
            $cliente->brazoR = $brazoR;
            $cliente->brazoC = $brazoC;
            $cliente->cintura = $cintura;
            $cliente->pierna = $pierna;
            $cliente->intereses = $preferencia;
            $cliente->genero = $sexo;
            $cliente->tipoUsuario = "cliente";

            $daoCliente = new DAOCliente();
            $idInsertado = $daoCliente->agregarCliente($cliente);

            if ($idInsertado > 0) {
                $mensaje = "Cliente registrado correctamente.";
            } else {
                $errores[] = "Ocurrió un error al registrar el cliente.";
            }

            if ($tipo === 'profesional') {
                $profesional = new Profesional();
                $profesional->nombreProfesional = $nombre;
                $profesional->apellidos = $apellidos;
                $profesional->email = $correo;
                $profesional->contrasenia = $password;
                $profesional->especialidad = $especialidad;
                $profesional->enfoque = $enfoque;
                $profesional->eslogan = $eslogan;
                $profesional->tipoUsuario = "profesional";

                $daoProfesional = new DAOProfesional();
                $idInsertado = $daoProfesional->agregarProfesional($profesional);

                if ($idInsertado > 0) {
                    $mensaje = "Profesional registrado correctamente.";
                } else {
                    $errores[] = "Ocurrió un error al registrar el profesional.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>BetterLife - Registro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilosregistro.css">
</head>

<body>
    <div class="login-container">
        <h2>Registro de Usuario</h2>

        <?php if (!empty($errores)): ?>
            <div id="errores" class="error">
                <ul>
                    <?php foreach ($errores as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php elseif (!empty($mensaje)): ?>
            <div class="success"><?= htmlspecialchars($mensaje) ?></div>
        <?php endif; ?>

        <form action="registrar.php" method="post">

            <div class="input-group">
                <label for="tipoUsuario">Tipo de usuario:</label>
                <select name="tipoUsuario" id="tipoUsuario">
                    <option value="cliente" <?= ($tipo === 'cliente') ? 'selected' : '' ?>>Cliente</option>
                    <option value="profesional" <?= ($tipo === 'profesional') ? 'selected' : '' ?>>Profesional</option>
                </select>
            </div>

            <div class="input-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>"
                    required>
            </div>
            <div class="input-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos"
                    value="<?= htmlspecialchars($_POST['apellidos'] ?? '') ?>" required>
            </div>
            <div class="input-group">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($_POST['correo'] ?? '') ?>"
                    required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirmar Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <div id="camposCliente">
                <div class="input-group"><label>Edad:</label><input type="number" name="txtEdad"
                        value="<?= htmlspecialchars($_POST['txtEdad'] ?? '') ?>" required></div>
                <div class="input-group"><label>Peso:</label><input type="text" name="txtPeso"
                        value="<?= htmlspecialchars($_POST['txtPeso'] ?? '') ?>" placeholder="Ej: 70kg" required></div>
                <div class="input-group"><label>Estatura:</label><input type="text" name="txtEstatura"
                        value="<?= htmlspecialchars($_POST['txtEstatura'] ?? '') ?>" placeholder="Ej: 170cm" required>
                </div>
                <div class="input-group"><label>Brazo Contraído:</label><input type="text" name="txtBrazoC"
                        value="<?= htmlspecialchars($_POST['txtBrazoC'] ?? '') ?>" placeholder="Ej: 34cm" required>
                </div>
                <div class="input-group"><label>Brazo Relajado:</label><input type="text" name="txtBrazoR"
                        value="<?= htmlspecialchars($_POST['txtBrazoR'] ?? '') ?>" placeholder="Ej: 32cm" required>
                </div>
                <div class="input-group"><label>Cintura:</label><input type="text" name="txtCintura"
                        value="<?= htmlspecialchars($_POST['txtCintura'] ?? '') ?>" placeholder="Ej: 70cm" required>
                </div>
                <div class="input-group"><label>Pierna:</label><input type="text" name="txtPierna"
                        value="<?= htmlspecialchars($_POST['txtPierna'] ?? '') ?>" placeholder="Ej: 45cm" required>
                </div>
                <div class="input-group">
                    <label for="sexo">Sexo:</label>
                    <select name="sexo" required>
                        <option value="">Seleccione...</option>
                        <option value="masculino" <?= ($_POST['sexo'] ?? '') == 'masculino' ? 'selected' : '' ?>>Masculino
                        </option>
                        <option value="femenino" <?= ($_POST['sexo'] ?? '') == 'femenino' ? 'selected' : '' ?>>Femenino
                        </option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="preferencia">¿Qué buscas?:</label>
                    <select name="preferencia" required>
                        <option value="">Seleccione...</option>
                        <option value="ejercicio" <?= ($_POST['preferencia'] ?? '') == 'ejercicio' ? 'selected' : '' ?>>
                            Rutina de gimnasio</option>
                        <option value="dieta" <?= ($_POST['preferencia'] ?? '') == 'dieta' ? 'selected' : '' ?>>Rutina de
                            comida</option>
                        <option value="ambas" <?= ($_POST['preferencia'] ?? '') == 'ambas' ? 'selected' : '' ?>>Ambas
                        </option>
                    </select>
                </div>
            </div>

            <div id="camposProfesional" style="display: none;">
                <div class="input-group"><label>Especialidad:</label><input type="text" name="txtEspecialidad"
                        value="<?= htmlspecialchars($_POST['txtEspecialidad'] ?? '') ?>"
                        placeholder="Nutriólogo, Entrenador..." required></div>
                <div class="input-group"><label>Enfoque:</label><input type="text" name="txtEnfoque"
                        value="<?= htmlspecialchars($_POST['txtEnfoque'] ?? '') ?>"
                        placeholder="Ej: Nutrición para rendimiento deportivo" required></div>
                <div class="input-group"><label>Eslogan:</label><input type="text" name="txtEslogan"
                        value="<?= htmlspecialchars($_POST['txtEslogan'] ?? '') ?>"
                        placeholder="Ej: ¡Transforma tu vida hoy!"></div>
            </div>

            <div id="errores" class="error" style="display: none;"></div>

            <button type="submit" formnovalidate onclick="">Registrarse</button>
        </form>

        <p>¿Ya tienes una cuenta?<a href="Login.php">Inicia sesión aquí</a></p>
    </div>

    <script src="Scripts/validacionRegistro.js"></script>
</body>

</html>