<?php
session_start();
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
                <legend class="kanit">Descripción de rutina</legend>
                <textarea name="txtRutina" id="txtRutina" placeholder="Describa la rutina aqui y lo que se espera lograr"></textarea>

                <legend class="kanit">Rutina</legend>
                <table border=1>
                    <thead>
                        <tr>
                            <td>
                                Dias de la semana
                            </td>
                            <td>
                                Area a entrenar
                            </td>
                            <td>
                                Ejercicios
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lunes</td>
                            <td>
                                <input type="text" name="txtLunes" id="txtLunes">
                            </td>
                            <td>
                                <input type="text" name="txtEjerciciosL" id="txtEjerciciosL">
                            </td>
                        </tr>
                        <tr>
                            <td>Martes</td>
                            <td>
                                <input type="text" name="txtMartes" id="txtMartes">
                            </td>
                            <td>
                                <input type="text" name="txtEjerciciosM" id="txtEjerciciosM">
                            </td>
                        </tr>
                        <tr>
                            <td>Miercoles</td>
                            <td>
                                <input type="text" name="txtMiercoles" id="txtMiercoles">
                            </td>
                            <td>
                                <input type="text" name="txtEjerciciosW" id="txtEjerciciosW">
                            </td>
                        </tr>
                        <tr>
                            <td>Jueves</td>
                            <td>
                                <input type="text" name="txtJueves" id="txtJueves">
                            </td>
                            <td>
                                <input type="text" name="txtEjerciciosJ" id="txtEjerciciosJ">
                            </td>
                        </tr>
                        <tr>
                            <td>Viernes</td>
                            <td>
                                <input type="text" name="txtViernes" id="txtViernes">
                            </td>
                            <td>
                                <input type="text" name="txtEjerciciosV" id="txtEjerciciosV">
                            </td>
                        </tr>
                        <tr>
                            <td>Sábado</td>
                            <td>
                                <input type="text" name="txtSabado" id="txtSabado">
                            </td>
                            <td>
                                <input type="text" name="txtEjerciciosS" id="txtEjerciciosS">
                            </td>
                        </tr>
                        <tr>
                            <td>Domingo</td>
                            <td>
                                <input type="text" name="txtDomingo" id="txtDomingo">
                            </td>
                            <td>
                                <input type="text" name="txtEjerciciosD" id="txtEjerciciosD">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" id="btnGuardar">Guardar y volver</button>
             </div>
       </form>
    </main>
</body>
</html>
