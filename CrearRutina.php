<?php
session_start();
require_once('Datos/DAORutina.php');
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
        <?php
        $cliente = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $cliente = (new DAORutina())->obtenerUno($_POST['id']);
        }
        ?>
        <form action="usuarios.php" method="post">
            <!-- Aquí irá el contenido del formulario -->
            <div class="contenedorInfo">
                <div class="DatosGenerales">
                    <legend class="kanit">Crear Rutina</legend>
                    <label for="lblCliente">Cliente:</label>
                    <input type="text" name="txtCliente" id="txtCliente" disabled value="<?= $cliente?->nombre ?? '' ?>">
                    <br>
                    <label for="lblEdad">Edad:</label>
                    <input type="number" name="txtEdad" id="txtEdad" disabled value="<?= $cliente?->edad ?? '' ?>">
                    <br>
                    <label for="lblPeso">Peso:</label>
                    <input type="text" name="txtPeso" id="txtPeso" disabled value="<?= $cliente?->peso ?? '' ?>">
                    <br>
                    <label for="lblEstatura">Estatura:</label>
                    <input type="text" name="txtEstatura" id="txtEstatura" disabled value="<?= $cliente?->estatura ?? '' ?>">
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
                    <input type="text" name="txtCintura" id="txtCintura" disabled value="<?= $cliente?->cintura ?? '' ?>">
                    <br>
                    <label for="lblPierna">Pierna:</label>
                    <input type="text" name="txtPierna" id="txtPierna" disabled value="<?= $cliente?->pierna ?? '' ?>">
                    <br>
                </div>
                <div>

                    <div class="Rutina">
                        <legend class="kanit">Descripción de rutina</legend>
                        <textarea name="txtRutina" id="txtRutina"
                            placeholder="Describa la rutina aqui y lo que se espera lograr"></textarea>

                        <legend class="kanit">Rutina</legend>
                        <?php
                        include_once('Datos/RutinaEjercicio.php');
                        echo "<br>";
                        include_once('Datos/RutinaDieta.php');
                        ?>
                        <button type="submit" id="btnGuardar">Guardar y volver</button>
                    </div>
        </form>
    </main>
</body>

</html>