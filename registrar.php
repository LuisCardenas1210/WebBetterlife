<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['tipoUsuario'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $mensaje = "Las contraseñas no coinciden.";
    } else {
        if ($tipo === 'cliente') {
            $edad = $_POST['txtEdad'];
            $peso = $_POST['txtPeso'];
            $estatura = $_POST['txtEstatura'];
            $brazoC = $_POST['txtBrazoC'];
            $brazoR = $_POST['txtBrazoR'];
            $cintura = $_POST['txtCintura'];
            $pierna = $_POST['txtPierna'];
            $sexo = $_POST['sexo'];
            $preferencia = $_POST['preferencia'];
            // Aquí deberías insertar en la tabla de Clientes
            $mensaje = "Cliente registrado correctamente: $nombre ($correo)";
        } else {
            $especialidad = $_POST['txtEspecialidad'];
            $enfoque = $_POST['txtEnfoque'];
            $eslogan = $_POST['txtEslogan'];
            // Aquí deberías insertar en la tabla de Profesionales
            $mensaje = "Profesional registrado correctamente: $nombre ($correo)";
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

    <?php if (isset($mensaje)) echo "<p><strong>$mensaje</strong></p>"; ?>

    <form action="registro.php" method="post">
        <div class="input-group">
            <label for="tipoUsuario">Tipo de usuario:</label>
            <select name="tipoUsuario" id="tipoUsuario" onchange="cambiarFormulario()">
                <option value="cliente">Cliente</option>
                <option value="profesional">Profesional</option>
            </select>
        </div>

        <!-- Comunes -->
        <div class="input-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="input-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>
        </div>
        <div class="input-group">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" required>
        </div>
        <div class="input-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="input-group">
            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>

        <!-- Cliente -->
        <div id="camposCliente">
            <div class="input-group"><label>Edad:</label><input type="number" name="txtEdad" required></div>
            <div class="input-group"><label>Peso:</label><input type="text" name="txtPeso" placeholder="Ej: 70kg" required></div>
            <div class="input-group"><label>Estatura:</label><input type="text" name="txtEstatura" placeholder="Ej: 170cm" required></div>
            <div class="input-group"><label>Brazo Contraído:</label><input type="text" name="txtBrazoC" placeholder="Ej: 34cm" required></div>
            <div class="input-group"><label>Brazo Relajado:</label><input type="text" name="txtBrazoR" placeholder="Ej: 32cm" required></div>
            <div class="input-group"><label>Cintura:</label><input type="text" name="txtCintura" placeholder="Ej: 70cm" required></div>
            <div class="input-group"><label>Pierna:</label><input type="text" name="txtPierna" placeholder="Ej: 45cm" required></div>
            <div class="input-group">
                <label for="sexo">Sexo:</label>
                <select name="sexo" required>
                    <option value="">Seleccione...</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </select>
            </div>
            <div class="input-group">
                <label for="preferencia">¿Qué buscas?:</label>
                <select name="preferencia" required>
                    <option value="">Seleccione...</option>
                    <option value="ejercicio">Rutina de gimnasio</option>
                    <option value="dieta">Rutina de comida</option>
                    <option value="ambas">Ambas</option>
                </select>
            </div>
        </div>

        <!-- Profesional -->
        <div id="camposProfesional" style="display: none;">
            <div class="input-group"><label>Especialidad:</label><input type="text" name="txtEspecialidad" placeholder="Nutriólogo, Entrenador..." required></div>
            <div class="input-group"><label>Enfoque:</label><input type="text" name="txtEnfoque" placeholder="Ej: Nutrición para rendimiento deportivo" required></div>
            <div class="input-group"><label>Eslogan:</label><input type="text" name="txtEslogan" placeholder="Ej: ¡Transforma tu vida hoy!"></div>
        </div>

        <button type="submit">Registrarse</button>
    </form>
    <p>¿Ya tienes una cuenta? <a href="Login.php">Inicia sesión aquí</a></p>
</div>

<script>
function cambiarFormulario() {
    const tipo = document.getElementById("tipoUsuario").value;
    document.getElementById("camposCliente").style.display = tipo === "cliente" ? "block" : "none";
    document.getElementById("camposProfesional").style.display = tipo === "profesional" ? "block" : "none";
}
window.onload = cambiarFormulario;
</script>
</body>
</html>
