<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetterLife</title>
    <link rel="stylesheet" href="css/estilosMain.css">
    <link rel="stylesheet" href="css/estilosCrearRutina.css">
</head>
<body>
    <?php
    require_once('Datos/header.php');
    ?>
    <main>
        <form action="usuarios.php">
            <!-- Aquí irá el contenido del formulario -->
              <div class="contenedorInfo">
                  <div class="DatosGenerales">
                    <legend class="kanit">Crear Rutina</legend>
                    <label for="lblCliente">Cliente:</label>
                    <input type="text" name="txtCliente" id="txtCliente"
                    disabled value="Nombre del cliente">
                    <br>
                    <label for="lblEdad">Edad:</label>
                    <input type="number" name="txtEdad" id="txtEdad"
                    disabled value="0">
                    <br>
                    <label for="lblPeso">Peso:</label>
                    <input type="number" name="txtPeso" id="txtPeso"
                    disabled value="0">
                    <br>
                    <label for="lblEstatura">Estatura:</label>
                    <input type="text" name="txtEstatura" id="txtEstatura"
                    disabled value="0cm">
                    <br>
                 </div>
                    <div class="DatosMedidas">
                    <legend class="kanit">Medidas</legend>
                    <label for="lblBrazoR">Brazo(Relajado):</label>
                    <input type="text" name="txtBrazoR" id="txtBrazoR"
                    disabled value="0cm">
                    <br>
                    <label for="lblBrazoC">Brazo(Contraido):</label>
                    <input type="text" name="txtBrazoC" id="txtBrazoC"
                    disabled value="0cm">
                    <br>
                    <label for="lblCintura">Cintura:</label>
                    <input type="text" name="txtCintura" id="txtCintura"
                    disabled value="0cm">
                    <br>
                    <label for="lblPierna">Pierna:</label>
                    <input type="text" name="txtPierna" id="txtPierna"
                    disabled value="0cm">
                    <br>
                 </div>
             <div>
             <div class="Rutina">
                <legend class="kanit">Rutina</legend>
                <textarea name="txtRutina" id="txtRutina" placeholder="Escriba la rutina aquí"></textarea>
                <button type="submit" id="btnGuardar">Guardar y volver</button>
             </div>
       </form>
    </main>
</body>
</html>
