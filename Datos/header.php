<header>
        <nav>
            <div class="logo"><a href="index.php">BetterLife</a></div>
            <ul class="menu">
                <li>Rutinas
                    <ul class="submenu">
                        <li class="liSubmenu"><a href="index.php#Ejercicios">Ejercicios</a></li>
                        <li class="liSubmenu"><a href="index.php#Dietas">Dietas</a></li>
                    </ul>
                </li>
                <li><a href="index.php#Profesionales">Profesionales</a></li>
            </ul>
            <div class="login">
                <?php if (isset($_SESSION["nombre"])):?>
                    <?php
                    
                    ?>
                    <ul class="menu">
                        <li>
                            <span>Bienvenido, <?= htmlspecialchars($_SESSION["nombre"]) ?></span>
                            <ul class="submenu">
                                <?php if (trim($_SESSION["tipoUsuario"]) === "cliente"): ?>
                                    <li class="liSubmenu"><a href="solicitar_rutina.php">Solicitar Rutina</a></li> 
                                    <li class="liSubmenu"><a href="ver_solicitudes.php">Ver solicitudes</a></li> 
                                    <li class="liSubmenu"><a href="ver_rutinas.php">Ver rutinas</a></li> 
                                <?php elseif($_SESSION["tipoUsuario"] === "profesional"): ?>
                                    <li class="liSubmenu"><a href="usuarios.php">Crear Rutina</a></li>
                                    <li class="liSubmenu"><a href="ver_solicitudes_profesionales.php">Ver Solicitudes</a></li>                                
                                <?php elseif($_SESSION["tipoUsuario"] === "admin      "): ?>
                                    <li class="liSubmenu"><a href="GestionUsuarios.php">Gestionar Usuarios</a></li>
                                    <li class="liSubmenu"><a href="gestionar_rutinas.php">Gestionar Rutinas</a></li>
                                <?php endif; ?>
                                <li class="liSubmenu"><a href="logout.php">Cerrar sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php else: ?>
                    <a href="Login.php">Login</a> / <a href="registrar.php">Registrar</a>
                <?php endif; ?>
            </div>

        </nav>
    </header>
