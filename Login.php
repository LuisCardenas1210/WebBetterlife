<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetterLife</title>
    <link rel="stylesheet" href="css/estilosregistro.css">
</head>
<body>
    <?php
    include_once 'Controller/CargarUsuario.php';
    if(!empty($_POST)){
        if(isset($_POST["email"])&&isset($_POST["password"])){
            for($i=0;$i<count($Lista_usuarios);$i++){
                if($Lista_usuarios[$i]->correoE==$_POST["email"]&&
                $Lista_usuarios[$i]->contrasenia==$_POST["password"]){
                    session_start();
                    $_SESSION["email"]=$Lista_usuarios[$i]->nombre;
                    header("Location: index.php");
                }
            }
        }
    }
    ?>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form method="post">
            <div class="input-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required autocomplete="off"
                value="<?= isset($POST["email"])?$POST["email"]:"" ?>">
            </div>
            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required
                value="<?= isset($POST["password"])?$POST["password"]:"" ?>">
            </div>
            <button type="submit">Ingresar</button>
            <!-- <button type="button"  onclick="location.href='index.php'">Ingresar</button> -->
        </form>
        <p>¿No tienes una cuenta? <a href="Registrar.html">Regístrate aquí</a></p>
    </div>
    <?php
    var_dump($_POST);
    ?>
</body>
</html>
