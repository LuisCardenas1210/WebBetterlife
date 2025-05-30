<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetterLife</title>
    <link rel="stylesheet" href="css/estilosProfesionales.css">
    <link rel="stylesheet" href="css/estilosMain.css">
</head>
<body>
    <?php
    require_once('Datos/header.php');
    ?>
    <main>
        <table>
            <thead class="kanit">
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Profesion</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        <img src="imgs/nutriologo.jpg">
                    </th>
                    <th>Juan Fernando Perez Vaeza</th>
                    <th>Nutriologo</th>
                    <th>
                        <p>Especialidad: Nutrición clínica y deportiva
                            Grado Académico: Licenciado en Nutrición, con Maestría en Nutrición Deportiva
                            Experiencia: Más de 10 años ayudando a personas a mejorar su alimentación y alcanzar sus objetivos de salud</p>
                    </th>
                </tr>
                <tr>
                    <th>
                        <img src="imgs/entrenador.jpg">
                    </th>
                    <th>Alberto Jaime Sanchez</th>
                    <th>Entrenador Personal</th>
                    <th>
                        <p>Especialidad: Entrenamiento funcional, musculación y acondicionamiento físico
                            Grado Académico: Licenciado en Ciencias del Deporte, Certificado en Entrenamiento Personal y Nutrición Deportiva
                            Experiencia: Más de 8 años ayudando a personas a mejorar su condición física, alcanzar sus objetivos de fuerza y transformar su estilo de vida</p>
                    </th>
                </tr>
            </tbody>
        </table>
    </main>
</body>
</html>