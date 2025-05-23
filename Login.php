<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - BetterLife</title>
    <link rel="stylesheet" href="css/estilosregistro.css">
    <script src="js/validacionLogin.js" defer></script>
</head>
<body>
<?php
    include_once 'Datos/DAOUsuario.php';
/* echo "<pre>";
var_dump($Lista_usuarios);
echo "</pre>"; */

    if(!empty($_POST)){
            //isset verifica que la variable venga en POST
        if(isset($_POST["email"]) && isset($_POST["password"])){    
            $correoE=(new DAOUsuario())->autenticar($_POST["email"],
                                        $_POST["password"]);
            if($correoE!=null){
                    session_start();
                    $_SESSION["email"]="$correoE->nombre $correoE->apellidos";
                    $_SESSION["nombre"]=$correoE->nombre;
                    $_SESSION["tipoUsuario"]=$correoE->tipoUsuario;
                    header("Location: index.php");
            }else{
                echo "<div style='color: red;'>Usuario y/o contraseña incorrectos</div>";
            }            
        }else{
            if(!isset($_POST["email"]) || trim($_POST["email"])=="" ||
            !isset($_POST["password"]) || trim($_POST["password"])==""){
            ?>
                <div style="color: red;">Ingresa los datos</div>
            <?php
            }else{
                //Datos incorrectos
                echo "<div style='color: red;'>Usuario y/o contraseña incorrectos</div>";
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
                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
        </div>
        <div class="input-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required
                value="<?= isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>">
        </div>
        <button type="submit" formnovalidate>Ingresar</button>
    </form>
    <p>¿No tienes una cuenta? <a href="registrar.html">Regístrate aquí</a></p>
    <script src="Scripts/validacionLogin.js"></script>
</div>
</body>
</html>
