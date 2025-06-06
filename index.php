<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetterLife</title>
    <link rel="stylesheet" href="css/estilosMain.css">
</head>
<body>
    <?php
    require_once('Datos/header.php');
    ?>
    <main id="Inicio">
        <br><br>
        <div class="carrusel">
            <div class="imagenes">
                <div class="imagen" onclick="irAPagina('#')">
                    <img src="imgs/banner1.png" alt="Imagen 1">
                    <div class="texto">
                        <div class="titulo">Título 1</div>
                        <div class="subtitulo">Subtema 1</div>
                    </div>
                </div>
                <div class="imagen" onclick="irAPagina('#')">
                    <img src="imgs/banner2.1.jpg" alt="Imagen 2">
                    <div class="texto">
                        <div class="titulo">Título 2</div>
                        <div class="subtitulo">Subtema 2</div>
                    </div>
                </div>
                <div class="imagen" onclick="irAPagina('#')">
                    <img src="imgs/banner3.png" alt="Imagen 3">
                    <div class="texto">
                        <div class="titulo">Título 3</div>
                        <div class="subtitulo">Subtema 3</div>
                    </div>
                </div>
            </div>
    
            <button class="flecha izquierda" onclick="cambiarImagen(-1)">❮</button>
            <button class="flecha derecha" onclick="cambiarImagen(1)">❯</button>
        </div>
    
        <script>
            let indice = 0;
            const imagenes = document.querySelector('.imagenes');
            const totalImagenes = document.querySelectorAll('.imagen').length;
        
            function cambiarImagen(direccion) {
                indice = (indice + direccion + totalImagenes) % totalImagenes;
                imagenes.style.transform = `translateX(-${indice * 100}%)`;
            }
        
            function irAPagina(url) {
                window.location.href = url;
            }
        
            setInterval(() => cambiarImagen(1), 4200);
        </script>



        <h1>RUTINAS</h1>
        <a href="Rutina.php">
            <section id="Ejercicios" class="exercise">
                <h2 >Ejercicios</h2>
                <div class="content">
                    <img src="imgs/gym.jpg" alt="Imagen rutina">
                    <p>RUTINA DE ENTRENAMIENTO PARA FUERZA Y DEFINICIÓN MUSCULAR
                        
                        Distribución del entrenamiento:
                        Esta rutina está diseñada para trabajar todos los 
                        grupos musculares de manera equilibrada, enfocándose 
                        en el desarrollo de fuerza, resistencia y estabilidad. 
                        Se divide en sesiones específicas para cada grupo muscular,
                        asegurando una recuperación óptima y un progreso continuo.

                        Consejos del Coach:
                        ✔️ Mantén una técnica controlada en cada ejercicio para evitar lesiones.
                        ✔️ Ajusta los pesos según tu nivel de fuerza y progresión.
                        ✔️ No olvides calentar antes de entrenar y estirar después de cada sesión.
                        ✔️ Complementa esta rutina con una alimentación adecuada para optimizar los resultados.</p>
                </div>
            </section>
        </a>
        <a href="Rutina.php#dieta">
            
            <section id="Dietas" class="diet">
                <h2 >Dietas</h2>
                <div class="content">
                    <p>DIETA PARA FUERZA Y DEFINICIÓN

                        Frecuencia: Todos los días
                        
                        Objetivo: Optimizar el desarrollo muscular y mejorar la 
                        composición corporal, asegurando un balance adecuado de
                        proteínas, carbohidratos y grasas saludables.
                        Hidratación recomendada: 2-3 litros de agua al día para 
                        un óptimo rendimiento y recuperación muscular.

                        Consejos del Nutriólogo:
                        ✔️ Ajusta las porciones según tu gasto calórico y objetivo de composición corporal.
                        ✔️ Mantén un balance adecuado de proteínas, carbohidratos y grasas saludables para mejorar tu rendimiento.
                        ✔️ No te saltes comidas para mantener niveles de energía estables y una óptima recuperación muscular.
                        ✔️ Complementa este plan con una rutina de entrenamiento adecuada para potenciar los resultados.</p>
                    
                    <img src="imgs/dieta.png" alt="Imagen rutina">
                </div>
            </section>
        </a>

        <section id="Profesionales" class="professionals">
            <h2>Profesionales</h2>
            <p>Descripción de las capacidades de los profesionales, títulos, maestrías, etc.</p>
            <a href="Profesionales.php">
                <div class="profile">
                    <img src="imgs/nutriologo.jpg" alt="Foto del profesional">
                    <p>             Juan Perez - Nutriologo Certificado
                        Áreas de enfoque:
                        Planes personalizados de alimentación
                        Nutrición para el rendimiento deportivo
                        Control de peso y hábitos saludables
                        Asesoría para enfermedades metabólicas (diabetes, hipertensión, etc.)
                        
                        "Mi misión es ayudarte a encontrar un equilibrio en tu alimentación para mejorar tu bienestar y calidad de vida."
                        
                        ¡Agenda una consulta y comencemos juntos tu transformación!</p>
                </div>
            </a>
            <br><br><br>
            <a href="Profesionales.php">
                <div class="profile">
                    <img src="imgs/entrenador.jpg" alt="Foto del profesional">
                    <p>             Alberto Jaime - Entrenador personal
                    
                    Áreas de enfoque:

                        Entrenamiento personalizado según objetivos (pérdida de peso, ganancia muscular, tonificación)
                        Rutinas especializadas para principiantes y avanzados
                        Preparación para competencias fitness y culturismo
                        Corrección de técnica y prevención de lesiones
                        Motivación y hábitos saludables para un cambio duradero
                        
                        "No se trata solo de entrenar, sino de construir una versión más fuerte y saludable de ti mismo. ¡Estoy aquí para guiarte en cada paso del camino!"

                        ¡Agenda una sesión y comencemos juntos tu transformación!</p>
                </div>
            </a>
        </section>
    </main>

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
