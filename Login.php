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
        if(isset($_POST["correo"])&&isset($_POST["pass"])){
            for($i;$i<count($lista_usuarios);$i++){
                if($lista_usuarios[$i]->correoE==$_POST["correo"]&&
                $lista_usuarios[$i]->contrasenia==$_POST["pass"]){
                    session_start();
                    $_SESSION["correo"]=$lista_usuarios[$i]->nombre;
                    header("Location: index.php");
                }
            }
        }
    }else{
        /* if(!isset($_POST["correo"])||$_POST["correo"]==""
        ||!isset($_POST["pass"])||$_POST["pass"]==""){
            echo "<div style='color: red;'>Ingresa los datos</div>";
        }else{
            echo "<div style='color: red;'>Datos incorrectos</div>";
        } */
    }
    ?>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="index.php" method="post">
            <div class="input-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required autocomplete="off"
                value="<?= isset($POST["correo"])?$POST["correo"]:"" ?>">
            </div>
            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required
                value="<?= isset($POST["pass"])?$POST["pass"]:"" ?>">
            </div>
            <button type="submit">Ingresar</button>
        </form>
        <p>¿No tienes una cuenta? <a href="Registrar.html">Regístrate aquí</a></p>
    </div>
</body>
</html>
