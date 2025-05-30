<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Rutina Semanal</title>
    <link rel="stylesheet" href="css/estilosMain.css">
    <link rel="stylesheet" href="css/estilosVer_rutinas.css">
    <style>
        table {
            margin-top: 10px;
            margin-left: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
        body{
            margin-top: 100px;
        }
    </style>
    
</head>

<body>
<?php require_once('Datos/header.php'); ?>

<?php
require_once 'Datos/DAORutina.php';

$id_cliente = 1;

$daoRutina = new DAORutina();
$rutinas = $daoRutina->obtenerRutinasPorCliente($id_cliente);

if ($rutinas):
    foreach ($rutinas as $rutina):
        $tipo = strtolower($rutina['tiporutina']);
        ?>
        <h2>Rutina semanal (<?php echo ucfirst($tipo); ?>)</h2>
        <table>
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
                    $detalleKey = ($dia === 'miercoles') ? 'detallesw' : 'detalles' . 
                    substr($dia, 0, 1); // l, m, w, j, v, s, d
                    echo "<tr>
                            <td>" . ucfirst($dia) . "</td>
                            <td>" . htmlspecialchars($rutina[$dia]) . "</td>
                            <td>" . htmlspecialchars($rutina[$detalleKey]) . "</td>
                        </tr>";
                }
            ?>

            </tbody>
        </table>
        <br><br>
    <?php
    endforeach;
else:
    echo "<p style='margin-left: 20px;'>No se encontró ninguna rutina para este cliente.</p>";
endif;
?>
</body>
</html>
