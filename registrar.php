<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetterLife</title>
    <link rel="stylesheet" href="css/estilosregistro.css">
</head>

<body>
    <div class="registro-container">
        <h2>Registro de Usuario</h2>
        <form action="index.php" method="post">
            <div class="input-group">
                <label for="lblTipoUsuario">Tipo de usuario:</label>
                <select name="tipoUsuario" id="tipoUsuario" onchange="cambiarFormulario()">
                    <option value="cliente">Cliente</option>
                    <option value="profesional">Profesional</option>
                </select>
            </div>
            <!-- Campos en común -->
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
            <?php
            $tipo = $_POST['tipoUsuario'];
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];

            if ($tipo === 'cliente') {
                $objetivo = $_POST['objetivo'];
                $edad = $_POST['edad'];
                // Guardar en tabla de clientes
                echo "Cliente registrado: $nombre, $correo, objetivo: $objetivo, edad: $edad";
            } else {
                $especialidad = $_POST['especialidad'];
                $certificaciones = $_POST['certificaciones'];
                // Guardar en tabla de profesionales
                echo "Profesional registrado: $nombre, $correo, especialidad: $especialidad, certif.: $certificaciones";
            }
            ?>

            <!-- Campos para Cliente -->
            <div id="camposCliente">
                <div class="input-group">
                    <label for="lblEdad">Edad:</label>
                    <input type="number" id="txtEdad" name="txtEdad" required>
                </div>
                <div class="input-group">
                    <label for="lblPeso">Peso:</label>
                    <input type="text" id="txtPeso" name="txtPeso" required
                    placeholder="Ej: 70kg">
                </div>
                <div class="input-group">
                    <label for="lblEstatura">Estatura:</label>
                    <input type="text" id="txtEstatura" name="txtEstatura" required
                    placeholder="Ej: 170cm">
                </div>
                <div class="input-group">
                    <label for="lblBrazoC">Brazo Contraído:</label>
                    <input type="text" id="txtBrazoC" name="txtBrazoC" required
                    placeholder="Ej: 34cm">
                </div>
                <div class="input-group">
                    <label for="lblBrazoR">Brazo Relajado:</label>
                    <input type="text" id="txtBrazoR" name="txtBrazoR" required
                    placeholder="Ej: 32cm">
                </div>
                <div class="input-group">
                    <label for="lblCintura">Cintura:</label>
                    <input type="text" id="txtCintura" name="txtCintura" required
                    placeholder="Ej: 70cm">
                </div>
                <div class="input-group">
                    <label for="lblPierna">Pierna:</label>
                    <input type="text" id="txtPierna" name="txtPierna" required
                    placeholder="Ej: 45cm">
                </div>
                <div class="input-group">
                    <label for="sexo">Sexo:</label>
                    <select id="sexo" name="sexo" required>
                        <option value="">Seleccione...</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="preferencia">¿Qué buscas?:</label>
                    <select id="preferencia" name="preferencia" required>
                        <option value="">Seleccione...</option>
                        <option value="ejercicio">Rutina de gimnasio</option>
                        <option value="dieta">Rutina de comida</option>
                        <option value="ambas">Ambas</option>
                    </select>
                </div>
            </div>
            <!-- Campos para Profesional -->
            <div id="camposProfesional">
                <div class="input-group">
                    <label for="lblEspecialidad">Especialidad:</label>
                    <input type="text" id="txtEspecialidad" name="txtEspecialidad" required
                        placeholder="Nutriologo, Entrenador, etc.">
                </div>
                <div class="input-group">
                    <label for="lblEnfoque">Enfoque:</label>
                    <input type="text" id="txtEspecialidad" name="txtEspecialidad" required
                        placeholder="Ej: Nutrición para rendimiento deportivo, Preparación para competencias fitness">
                </div>
                <div class="input-group">
                    <label for="lblEslogan">Eslogan:</label>
                    <input type="text" id="txtEslogan" name="txtEslogan">
                </div>
            </div>
            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes una cuenta? <a href="Login.php">Inicia sesión aquí</a></p>
    </div>
    <script src="Scripts\validacionRegistro.js"></script>
</body>

</html>