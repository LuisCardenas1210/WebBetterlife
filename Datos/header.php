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
                    # print_r($_SESSION);
                    # var_dump(trim($_SESSION["tipoUsuario"]) );
                    ?>
                    <ul class="menu">
                        <li>
                            <span>Bienvenido, <?= htmlspecialchars($_SESSION["nombre"]) ?></span>
                            <ul class="submenu">
                                <?php if (trim($_SESSION["tipoUsuario"]) === "cliente"): ?>
                                    <li class="liSubmenu"><a href="#">Solicitar dieta</a></li> <!-- solicitar_dieta.php -->
                                    <li class="liSubmenu"><a href="#">Solicitar ejercicios</a></li> <!-- solicitar_ejercicios.php -->
                                    <li class="liSubmenu"><a href="#">Ver solicitudes</a></li> <!-- ver_solicitudes.php -->
                                    <li class="liSubmenu"><a href="ver_rutinas.php">Ver rutinas</a></li> <!-- ver_rutinas.php -->
                                <?php elseif($_SESSION["tipoUsuario"] === "profesional"): ?>
                                    <li class="liSubmenu"><a href="usuarios.php">Crear Rutina</a></li>
                                    <li class="liSubmenu"><a href="Solicitudes.php">Ver Solicitudes</a></li>                                
                                <?php elseif($_SESSION["tipoUsuario"] === "admin      "): ?>
                                    <li class="liSubmenu"><a href="GestionUsuarios.php">Gestionar Usuarios</a></li>
                                    <li class="liSubmenu"><a href="#">Gestionar Rutinas</a></li>
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
