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
                <input type="text" name="Area Lunes" class="dia" value="<?= htmlspecialchars($_POST['Area Lunes'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ejercicios Lunes" class="detalle" value="<?= htmlspecialchars($_POST['Ejercicios Lunes'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Martes</td>
            <td>
                <input type="text" name="Area Martes" class="dia" value="<?= htmlspecialchars($_POST['Area Martes'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ejercicios Martes" class="detalle" value="<?= htmlspecialchars($_POST['Ejercicios Martes'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Miercoles</td>
            <td>
                <input type="text" name="Area Miercoles" class="dia" value="<?= htmlspecialchars($_POST['Area Miercoles'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ejercicios Miercoles" class="detalle" value="<?= htmlspecialchars($_POST['Ejercicios Miercoles'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Jueves</td>
            <td>
                <input type="text" name="Area Jueves" class="dia" value="<?= htmlspecialchars($_POST['Area Jueves'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ejercicios Jueves" class="detalle" value="<?= htmlspecialchars($_POST['Ejercicios Jueves'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Viernes</td>
            <td>
                <input type="text" name="Area Viernes" class="dia" value="<?= htmlspecialchars($_POST['Area Viernes'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ejercicios Viernes" class="detalle" value="<?= htmlspecialchars($_POST['Ejercicios Viernes'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Sábado</td>
            <td>
                <input type="text" name="Area Sabado" class="dia" value="<?= htmlspecialchars($_POST['Area Sabado'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ejercicios Sabado" class="detalle" value="<?= htmlspecialchars($_POST['Ejercicios Sabado'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Domingo</td>
            <td>
                <input type="text" name="Area Domingo" class="dia" value="<?= htmlspecialchars($_POST['Area Domingo'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ejercicios Domingo" class="detalle" value="<?= htmlspecialchars($_POST['Ejercicios Domingo'] ?? '') ?>">
            </td>
        </tr>
    </tbody>
</table>