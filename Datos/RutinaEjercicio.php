<table border=1>
    <thead>
        <tr>
            <td>
                Dias de la semana
            </td>
            <td>
                Grupo muscular
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
                <input type="text" name="Area_Lunes" class="dia" value="<?= htmlspecialchars($_POST['Area_Lunes'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ejercicios_Lunes" class="detalle" value="<?= htmlspecialchars($_POST['Ejercicios_Lunes'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Martes</td>
            <td>
                <input type="text" name="Area_Martes" class="dia" value="<?= htmlspecialchars($_POST['Area_Martes'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ejercicios_Martes" class="detalle" value="<?= htmlspecialchars($_POST['Ejercicios_Martes'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Miercoles</td>
            <td>
                <input type="text" name="Area_Miercoles" class="dia" value="<?= htmlspecialchars($_POST['Area_Miercoles'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ejercicios_Miercoles" class="detalle" value="<?= htmlspecialchars($_POST['Ejercicios_Miercoles'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Jueves</td>
            <td>
                <input type="text" name="Area_Jueves" class="dia" value="<?= htmlspecialchars($_POST['Area_Jueves'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ejercicios_Jueves" class="detalle" value="<?= htmlspecialchars($_POST['Ejercicios_Jueves'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Viernes</td>
            <td>
                <input type="text" name="Area_Viernes" class="dia" value="<?= htmlspecialchars($_POST['Area_Viernes'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ejercicios_Viernes" class="detalle" value="<?= htmlspecialchars($_POST['Ejercicios_Viernes'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Sábado</td>
            <td>
                <input type="text" name="Area_Sabado" class="dia" value="<?= htmlspecialchars($_POST['Area_Sabado'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ejercicios_Sabado" class="detalle" value="<?= htmlspecialchars($_POST['Ejercicios_Sabado'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Domingo</td>
            <td>
                <input type="text" name="Area_Domingo" class="dia" value="<?= htmlspecialchars($_POST['Area_Domingo'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ejercicios_Domingo" class="detalle" value="<?= htmlspecialchars($_POST['Ejercicios_Domingo'] ?? '') ?>">
            </td>
        </tr>
    </tbody>
</table>