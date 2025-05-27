<?php
require_once 'datos/Conexion.php';

// Obtener conexión a la base de datos
$conexion = Conexion::conectar();

// ID del cliente (puedes obtenerlo desde la URL o sesión)
$id_cliente = 1;

// Consulta a la tabla de Rutinas
$sql = "SELECT * FROM Rutinas WHERE id_cliente = :id";
$stmt = $conexion->prepare($sql);
$stmt->execute(['id' => $id_cliente]);
$rutina = $stmt->fetch(PDO::FETCH_ASSOC);

// Definir tipo de rutina manualmente o por lógica propia
$tipo = 'dieta'; // o 'ejercicio'

if ($rutina):
?>
    <h2>Rutina semanal (<?php echo ucfirst($tipo); ?>)</h2>
    <table border="1">
        <thead>
            <tr>
                <td>Día</td>
                <td><?php echo ($tipo == 'dieta') ? 'Comida' : 'Área a entrenar'; ?></td>
                <td><?php echo ($tipo == 'dieta') ? 'Ingredientes o preparación' : 'Ejercicios'; ?></td>
            </tr>
        </thead>
        <tbody>
        <?php
        $dias = ["lunes", "martes", "miercoles", "jueves", "viernes", "sabado", "domingo"];
        foreach ($dias as $dia) {
            echo "<tr>
                    <td>" . ucfirst($dia) . "</td>
                    <td><input type='text' name='txt$dia' value='{$rutina[$dia]}'></td>
                    <td><input type='text' name='txtExtra$dia'></td>
                </tr>";
        }
        ?>
        </tbody>
    </table>
<?php
else:
    echo "No se encontró una rutina para este cliente.";
endif;
// Conexion::desconectar();
?>
