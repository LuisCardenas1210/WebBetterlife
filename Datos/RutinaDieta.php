<table border=1>
    <thead>
        <tr>
            <td>
                Dias de la semana
            </td>
            <td>
                Comida
            </td>
            <td>
                Ingredientes o forma de preparación
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Lunes</td>
            <td>
                <input type="text" name="Comida_Lunes" class="dia" value="<?= htmlspecialchars($_POST['Comida_Lunes'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ingredientes_Lunes" class="detalle" value="<?= htmlspecialchars($_POST['Ingredientes_Lunes'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Martes</td>
            <td>
                <input type="text" name="Comida_Martes" class="dia" value="<?= htmlspecialchars($_POST['Comida_Martes'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ingredientes_Martes" class="detalle" value="<?= htmlspecialchars($_POST['Ingredientes_Martes'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Miercoles</td>
            <td>
                <input type="text" name="Comida_Miercoles" class="dia" value="<?= htmlspecialchars($_POST['Comida_Miercoles'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ingredientes_Miercoles" class="detalle" value="<?= htmlspecialchars($_POST['Ingredientes_Miercoles'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Jueves</td>
            <td>
                <input type="text" name="Comida_Jueves" class="dia" value="<?= htmlspecialchars($_POST['Comida_Jueves'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ingredientes_Jueves" class="detalle" value="<?= htmlspecialchars($_POST['Ingredientes_Jueves'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Viernes</td>
            <td>
                <input type="text" name="Comida_Viernes" class="dia" value="<?= htmlspecialchars($_POST['Comida_Viernes'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ingredientes_Viernes" class="detalle" value="<?= htmlspecialchars($_POST['Ingredientes_Viernes'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Sábado</td>
            <td>
                <input type="text" name="Comida_Sabado" class="dia" value="<?= htmlspecialchars($_POST['Comida_Sabado'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ingredientes_Sabado" class="detalle" value="<?= htmlspecialchars($_POST['Ingredientes_Sabado'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Domingo</td>
            <td>
                <input type="text" name="Comida_Domingo" class="dia" value="<?= htmlspecialchars($_POST['Comida_Domingo'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ingredientes_Domingo" class="detalle" value="<?= htmlspecialchars($_POST['Ingredientes_Domingo'] ?? '') ?>">
            </td>
        </tr>
    </tbody>
</table>