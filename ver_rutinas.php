<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Rutina Semanal</title>
    <link rel="stylesheet" href="css/estilosMain.css">
</head>

<body>
<?php require_once('Datos/header.php'); ?>

<?php
require_once 'datos/Conexion.php';


$conexion = Conexion::conectar();


$id_cliente = 1;

$sql = "SELECT * FROM rutinas WHERE id_cliente = :id";
$stmt = $conexion->prepare($sql);
$stmt->execute(['id' => $id_cliente]);
$rutinas = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($rutinas):
    foreach ($rutinas as $rutina):
        $tipo = strtolower($rutina['tiporutina']);
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
                        <td>" . htmlspecialchars($rutina[$dia]) . "</td>
                        <td><input type='text' name='txtExtra{$rutina['id_rutina']}{$dia}'></td>
                      </tr>";
            }
            ?>
            </tbody>
        </table>
        <br><br>
    <?php
    endforeach;
else:
    echo "No se encontró ninguna rutina para este cliente.";
endif;  

?>
</body>
</html>