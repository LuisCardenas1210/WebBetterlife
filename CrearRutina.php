<?php
session_start();
require_once 'Datos/DAORutina.php';
require_once 'Datos/DAOSolicitud.php';
require_once 'Modelos/Rutina.php';


$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'volver') {
        // Redirige a la vista anterior, por ejemplo al listado de solicitudes o dashboard
        header("Location: usuarios.php"); // Ajusta la ruta si es necesario
        exit;
    }

    if ($accion === 'guardar') {
        // Validar datos
        $errores = [];

        if (empty(trim($_POST['txtRutina'] ?? ''))) {
            $errores[] = "Debe ingresar una Descripción de la rutina.";
        }

        $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
        $esDieta = false;
        foreach ($dias as $dia) {
            if (isset($_POST["Comida $dia"]) || isset($_POST["Ingredientes $dia"])) {
                $esDieta = true;
                break;
            }
        }

        foreach ($dias as $dia) {
            if ($esDieta) {
                $campoDia = "Comida $dia";
                $campoDetalle = "Ingredientes $dia";
            } else {
                $campoDia = "Area $dia";
                $campoDetalle = "Ejercicios $dia";
            }

            if (empty(trim($_POST[$campoDia] ?? ''))) {
                $errores[] = "Debe ingresar $campoDia.";
            }
            if (empty(trim($_POST[$campoDetalle] ?? ''))) {
                $errores[] = "Debe ingresar $campoDetalle.";
            }
        }

        if (!empty($errores)) {
            $_SESSION['errores'] = $errores;
            header("Location: CrearRutina.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetterLife</title>
    <link rel="stylesheet" href="css\estilosMain.css">
    <link rel="stylesheet" href="css\estilosCrearRutina.css">
</head>

<body>
    <?php
    require_once('Datos/header.php');
    ?>
    <main>
        <?php if (isset($_SESSION['errores'])): ?>
            <div id="errores" class="error">
                <?php foreach ($_SESSION['errores'] as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach;
                unset($_SESSION['errores']); ?>
            </div>
        <?php endif; ?>
        <?php
        $cliente = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_Usuario'])) {
            $cliente = (new DAORutina())->obtenerUno($_POST['id_Usuario']);
        }
        ?>
        <form action="CrearRutina.php" method="POST">
            <input type="hidden" name="id_Usuario" value="<?= htmlspecialchars($_POST['id_Usuario'] ?? '') ?>">
            <input type="hidden" name="id_Solicitud" value="<?= htmlspecialchars($_POST['id_Solicitud'] ?? '') ?>">

            <!-- Aquí irá el contenido del formulario -->
            <div class="contenedorInfo">
                <div class="DatosGenerales">
                    <legend class="kanit">Crear Rutina</legend>
                    <label for="lblCliente">Cliente:</label>
                    <input type="text" name="txtCliente" id="txtCliente" disabled
                        value="<?= $cliente?->nombre ?? '' ?>">
                    <br>
                    <label for="lblEdad">Edad:</label>
                    <input type="number" name="txtEdad" id="txtEdad" disabled value="<?= $cliente?->edad ?? '' ?>">
                    <br>
                    <label for="lblPeso">Peso:</label>
                    <input type="text" name="txtPeso" id="txtPeso" disabled value="<?= $cliente?->peso ?? '' ?>">
                    <br>
                    <label for="lblEstatura">Estatura:</label>
                    <input type="text" name="txtEstatura" id="txtEstatura" disabled
                        value="<?= $cliente?->estatura ?? '' ?>">
                    <br>
                </div>
                <div class="DatosMedidas">
                    <legend class="kanit">Medidas</legend>
                    <label for="lblBrazoR">Brazo(Relajado):</label>
                    <input type="text" name="txtBrazoR" id="txtBrazoR" disabled value="<?= $cliente?->brazoR ?? '' ?>">
                    <br>
                    <label for="lblBrazoC">Brazo(Contraido):</label>
                    <input type="text" name="txtBrazoC" id="txtBrazoC" disabled value="<?= $cliente?->brazoC ?? '' ?>">
                    <br>
                    <label for="lblCintura">Cintura:</label>
                    <input type="text" name="txtCintura" id="txtCintura" disabled
                        value="<?= $cliente?->cintura ?? '' ?>">
                    <br>
                    <label for="lblPierna">Pierna:</label>
                    <input type="text" name="txtPierna" id="txtPierna" disabled value="<?= $cliente?->pierna ?? '' ?>">
                    <br>
                </div>
                <div class="Rutina">
                    <legend class="kanit">Descripción de rutina</legend>
                    <textarea name="txtRutina" id="txtRutina"
                        placeholder="Describa la rutina aqui y lo que se espera lograr"><?= htmlspecialchars($_POST['txtRutina'] ?? '') ?></textarea>

                    <legend class="kanit">Rutina</legend>
                    <?php
                    $solicitud = null;
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_Solicitud'])) {
                        $solicitud = (new DAOSolicitud())->obtenerTipoRutina($_POST['id_Solicitud']);
                    }
                    if ($solicitud === "ejercicio") {
                        include_once('Datos/RutinaEjercicio.php');
                    } else {
                        include_once('Datos/RutinaDieta.php');
                    }
                    ?>
                    <div id="erroresjs" class="error" style="display: none;"></div>
                    <?php if (isset($_SESSION['errores'])): ?>
                        <div id="errores" class="error">
                            <?php foreach ($_SESSION['errores'] as $error): ?>
                                <p><?= htmlspecialchars($error) ?></p>
                            <?php endforeach;
                            unset($_SESSION['errores']); ?>
                        </div>
                    <?php endif; ?>
                    <div id="botones">
                        <button type="submit" name="accion" value="guardar" id="btnGuardar">Guardar</button>
                        <button type="submit" name="accion" value="volver" id="btnVolver" formnovalidate>Volver</button>
                    </div>
                </div>
        </form>
    </main>
    <script src="Scripts/validacionCrearRutina.js"></script>
</body>

</html>