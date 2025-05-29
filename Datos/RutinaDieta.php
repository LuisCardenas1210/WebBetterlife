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
                <input type="text" name="Comida Lunes" class="dia" value="<?= htmlspecialchars($_POST['Comida Lunes'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ingredientes Lunes" class="detalle" value="<?= htmlspecialchars($_POST['Ingredientes Lunes'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Martes</td>
            <td>
                <input type="text" name="Comida Martes" class="dia" value="<?= htmlspecialchars($_POST['Comida Martes'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ingredientes Martes" class="detalle" value="<?= htmlspecialchars($_POST['Ingredientes Martes'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Miercoles</td>
            <td>
                <input type="text" name="Comida Miercoles" class="dia" value="<?= htmlspecialchars($_POST['Comida Miercoles'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ingredientes Miercoles" class="detalle" value="<?= htmlspecialchars($_POST['Ingredientes Miercoles'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Jueves</td>
            <td>
                <input type="text" name="Comida Jueves" class="dia" value="<?= htmlspecialchars($_POST['Comida Jueves'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ingredientes Jueves" class="detalle" value="<?= htmlspecialchars($_POST['Ingredientes Jueves'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Viernes</td>
            <td>
                <input type="text" name="Comida Viernes" class="dia" value="<?= htmlspecialchars($_POST['Comida Viernes'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ingredientes Viernes" class="detalle" value="<?= htmlspecialchars($_POST['Ingredientes Viernes'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Sábado</td>
            <td>
                <input type="text" name="Comida Sabado" class="dia" value="<?= htmlspecialchars($_POST['Comida Sabado'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ingredientes Sabado" class="detalle" value="<?= htmlspecialchars($_POST['Ingredientes Sabado'] ?? '') ?>">
            </td>
        </tr>
        <tr>
            <td>Domingo</td>
            <td>
                <input type="text" name="Comida Domingo" class="dia" value="<?= htmlspecialchars($_POST['Comida Domingo'] ?? '') ?>">
            </td>
            <td>
                <input type="text" name="Ingredientes Domingo" class="detalle" value="<?= htmlspecialchars($_POST['Ingredientes Domingo'] ?? '') ?>">
            </td>
        </tr>
    </tbody>
</table>