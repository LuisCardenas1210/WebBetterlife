<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetterLife</title>
    <link rel="stylesheet" href="css/estilosMain.css">
    <link rel="stylesheet" href="css/estilosRutina.css">
</head>
<body>
    <?php
    require_once('Datos/header.php');
    ?>
    
    <div id="Ejercicios">
        <h1 class="titulo">Rutina de Entrenamiento</h1>
        <p>Plan de ejercicios para fuerza y definición muscular.</p>
    </div>

    <section >
        <table>
            <thead>
                <tr>
                    <th>Día</th>
                    <th>Grupo Muscular</th>
                    <th>Ejercicios</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Lunes</td>
                    <td>Pierna</td>
                    <td>Sentadillas con barra, Peso muerto rumano, Prensa, Zancadas, Elevaciones de talón, Planchas</td>
                </tr>
                <tr>
                    <td>Martes</td>
                    <td>Pecho y Tríceps</td>
                    <td>Press de banca, Fondos, Aperturas, Press inclinado, Extensiones de tríceps, Fondos en banco</td>
                </tr>
                <tr>
                    <td>Miércoles</td>
                    <td>Espalda y Bíceps</td>
                    <td>Dominadas, Remo con barra, Pull-over, Curl de bíceps, Curl martillo, Encogimientos de hombros</td>
                </tr>
                <tr>
                    <td>Jueves</td>
                    <td>Hombros</td>
                    <td>Press militar, Elevaciones laterales y frontales, Pájaros, Plancha con elevación, Giros rusos</td>
                </tr>
                <tr>
                    <td>Viernes</td>
                    <td>Cardio y Pierna</td>
                    <td>Sentadillas búlgaras, Peso muerto, Saltos al cajón, Sprint en cinta o HIIT, Burpees</td>
                </tr>
            </tbody>
        </table>
    </section>

    <div id="Dietas">
        <h1 class="titulo" id="dieta">Dieta</h1>
        <p>Dieta para fuerza y definición muscular.</p>
    </div>
    <section>
        <p>
            Frecuencia: Todos los días 

            Objetivo: Aumento de masa muscular/Definición 

            Hidratación: 2-3 L de agua al día
        </p>
        <table>
            <thead>
                <th>Desayuno</th>
                <th>Snack de media mañana</th>
                <th>Almuerzo</th>
                <th>Merienda</th>
                <th>Cena</th>
            </thead>
            <tbody>
                <tr>
                    <td>4 claras + 1 huevo entero revueltos</td>
                    <td>1 puñado de almendras o nueces</td>
                    <td>150g de pechuga de pollo o pescado</td>
                    <td>Batido de Proteína con leche o agua </td>
                    <td>120g de carne magra (pollo, pescado o carne roja magra)</td>
                </tr>
                <tr>
                    <td>1 rebanada de pan integral con aguacate</td>
                    <td>1 yogur griego sin azúcar</td>
                    <td>1 taza de arroz integral o quinoa</td>
                    <td>1 banana</td>
                    <td>1 porción de ensalada con espinaca, tomate y zanahoria</td>
                </tr>
                <tr>
                    <td>1 taza de avena con canela y miel</td>
                    <td></td>
                    <td>1 porción de verduras al vapor</td>
                    <td>1 puño de frutos secos</td>
                    <td>1 boniato (camote) o una rebanada de pan integral</td>
                </tr>
                <tr>
                    <td>1 vaso de jugo de naranja natural</td>
                    <td></td>
                    <td>1 cucharada de aceite de oliva o aguacate</td>
                    <td></td>
                    <td>Snack Nocturno (Solo si te da hambre)</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>1 taza de queso cottage o yogur griego</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>1 cucharada de mantequilla de maní</td>
                </tr>
            </tbody>
        </table>
        <p>
                Consejos:
            Ajusta porciones según tu gasto calórico y objetivo.
            Mantén un balance de proteínas, carbohidratos y grasas saludables.
            No te saltes comidas para mantener la energía y la recuperación muscular.
        </p>
        
    </section>

    <footer>
        <div class="contact">
            <p>Contactanos</p>
            <div class="social-icons">
                <span>🟠</span><span>⚫</span><span>⚪</span>
            </div>
        </div>
        <div class="legal">
            <p>BetterLifeMX© 2025 All Rights Reserved.</p>
            <div class="legal2">
                <a href="#">Preguntas frecuentes</a>
                <a href="#">Aviso de Privacidad</a>
                <a href="#">Términos y condiciones</a>
            </div>
            
        </div>
    </footer>
</body>
</html>
