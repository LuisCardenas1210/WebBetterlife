<?php
session_start();

require_once 'Datos/DAORutina.php';
require_once 'Datos/DAOSolicitud.php';
require_once 'Modelos/Rutina.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_Usuario'])) {
        $_SESSION['id_Usuario'] = $_POST['id_Usuario'];
    }
    if (isset($_POST['id_Solicitud'])) {
        $_SESSION['id_Solicitud'] = $_POST['id_Solicitud'];
    }
}

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'volver') {
        unset($_SESSION['id_Usuario'], $_SESSION['id_Solicitud']);
        header("Location: usuarios.php");
        exit;
    }


    if ($accion === 'guardar') {
        $errores = [];

        if (empty(trim($_POST['txtRutina'] ?? ''))) {
            $errores[] = "Debe ingresar una Descripción de la rutina.";
        }

        $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];

        $solicitud = null;
        if (isset($_SESSION['id_Solicitud'])) {
            $solicitud = (new DAOSolicitud())->obtenerTipoRutina($_SESSION['id_Solicitud']);
        }


        foreach ($dias as $dia) {
            if ($solicitud === 'dieta') {
                $campoDia = "Comida_$dia";
                $campoDetalle = "Ingredientes_$dia";
            } else {
                $campoDia = "Area_$dia";
                $campoDetalle = "Ejercicios_$dia";
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

        $rutina = new Rutina();
        $rutina->id_Cliente = $_POST['id_Usuario'] ?? null;
        $rutina->id_Profesional = $_SESSION['id_profesional'] ?? null;
        $rutina->descripcionRutina = trim($_POST['txtRutina'] ?? '');
        $rutina->tiporutina = $solicitud ?? '';

        $dias_letras = [
            'Lunes' => 'L',
            'Martes' => 'M',
            'Miercoles' => 'W',
            'Jueves' => 'J',
            'Viernes' => 'V',
            'Sabado' => 'S',
            'Domingo' => 'D'
        ];

        foreach ($dias_letras as $dia => $letra) {
            if ($rutina->tiporutina === 'dieta') {
                $campoDia = "Comida_$dia";
                $campoDetalle = "Ingredientes_$dia";
            } else {
                $campoDia = "Area_$dia";
                $campoDetalle = "Ejercicios_$dia";
            }

            $propDia = strtolower($dia); 
            $propDetalle = "detalles$letra";

            $rutina->$propDia = trim($_POST[$campoDia] ?? '');
            $rutina->$propDetalle = trim($_POST[$campoDetalle] ?? '');
        }

        $dao = new DAORutina();
        $idInsertado = $dao->Agregar($rutina);

        if ($idInsertado > 0) {
            $dao->eliminarSolicitud($_SESSION['id_Solicitud']);

            $_SESSION['exito'] = "Rutina creada exitosamente.";
            header("Location: CrearRutina.php");
            exit;
        } else {
            $_SESSION['errores'] = ["Hubo un error al guardar la rutina. Intente nuevamente."];
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
        <?php if (isset($_SESSION['exito'])): ?>
            <div class="exito">
                <p><?= htmlspecialchars($_SESSION['exito']) ?></p>
            </div>
            <?php unset($_SESSION['exito']); ?>
        <?php endif; ?>

        <?php
        $cliente = null;
        if (isset($_SESSION['id_Usuario'])) {
            $cliente = (new DAORutina())->obtenerUno($_SESSION['id_Usuario']);
        }
        ?>
        <form action="CrearRutina.php" method="POST">
            <input type="hidden" name="id_Usuario" value="<?= htmlspecialchars($_SESSION['id_Usuario'] ?? '') ?>">
            <input type="hidden" name="id_Solicitud" value="<?= htmlspecialchars($_SESSION['id_Solicitud'] ?? '') ?>">

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
                    if (isset($_SESSION['id_Solicitud'])) {
                        $solicitud = (new DAOSolicitud())->obtenerTipoRutina($_SESSION['id_Solicitud']);
                    }
                    if ($solicitud === "ejercicio") {
                        include_once('Datos/RutinaEjercicio.php');
                    } else {
                        include_once('Datos/RutinaDieta.php');
                    }
                    ?>
                    <div id="erroresjs" class="error" style="display: none;"></div>
                    
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