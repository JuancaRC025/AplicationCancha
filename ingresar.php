<?php
session_start();


if (isset($_SESSION['id_usuario']) || isset($_SESSION['id_empresa'])) {
    // Si hay una sesión iniciada (ya sea de usuario o empresa)
    echo '<script>
            alert("Vaya parece que hay una sesión iniciada, cierra sesion Primero");
            window.location.href = "index.php";
          </script>';
    exit();
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

</head>

<body>

    <div class="header">
        <div class="logo">
            <img src="img/logo_solo.png" alt="Logo de tu sitio web">
        </div>
        <div class="titles">
            <h1 id="i1">PLAYGROUND PRO</h1>
            <h2 id="i2">"Encuentra, reserva y disfruta de canchas sintéticas al alcance de tu mano"</h2>
        </div>
    </div>

    <ul class="navbar">
        <li class="nav-item"><a href="index.php">Inicio</a></li>
        <li class="nav-item"><a href="canchas.php">Canchas</a></li>
        <li class="nav-item">
            <a href="https://api.whatsapp.com/send?phone=3027500507&text=Tengo%20problemas%20de%20acceso%20o%20requiero%20información.%20¿Me%20pueden%20ayudar%3F"
                target="_blank">Soporte</a>
        </li>

        <li class="nav-item dropdown">
            <a href="#">Registrar</a>
            <div class="dropdown-content" !important>
                <a href="reg_usuario.php
    ">Usuario</a>
                <a href="reg_empresa.php
    ">Empresa</a>
            </div>
        </li>
        <li class="nav-item"><a href="ingresar.php">Ingresar</a></li>
    </ul>
    <br>
    <br>
    <br>


    <!-- lo bueno  -->

    <main>

        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Eres un usuario?</h3>
                    <p>Inicia sesión como usuario para entrar y hacer tu reserva</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Eres una empresa?</h3>
                    <p>inicia sesion como empresa para administar tus canchas</p>
                    <button id="btn__registrarse">Iniciar Sesión</button>
                </div>
            </div>

            <!--Formulario de Login y registro-->
            <div class="contenedor__login-register">
                <!--Login usuario-->
                <form action="acceso.php" class="formulario__login" method="post">
                    <img src="img/perfil1.png" alt="login">
                    <h2>Iniciar Sesión</h2>
                    <input required type="email" placeholder="Correo Electronico" name="correo_u">

                    <div style="position: relative;">
                        <input required type="password" placeholder="Contraseña" name="Contraseña_i"
                            id="password-input">
                        <br>
                        <br>
                        <span id="toggle-password" class="password-icon" onclick="togglePassword()">

                            <i class="fas fa-eye-slash"></i>
                        </span>
                    </div>

                    <script>
                        function togglePassword() {
                            var passwordInput = document.getElementById("password-input");
                            var toggleIcon = document.getElementById("toggle-password");

                            if (passwordInput.type === "password") {
                                passwordInput.type = "text";
                                toggleIcon.innerHTML = '<i class="fas fa-eye"></i>';
                            } else {
                                passwordInput.type = "password";
                                toggleIcon.innerHTML = '<i class="fas fa-eye-slash"></i>';
                            }
                        }
                    </script>


                    <button>Entrar</button>
                </form>

                <!--login empresa-->
                <form action="acceso_e.php" class="formulario__register" method="post">
                    <img src="img/empresa.png" alt="login">
                    <h2>Iniciar Sesión</h2>
                    <input required type="email" placeholder="Correo Electronico" name="correo_u">

                    <div style="position: relative;">
                        <input required type="password" placeholder="Contraseña" name="Contraseña_i"
                            id="password-input">
                            
                    </div>
                    <button>Entrar</button>


                </form>
            </div>
        </div>

    </main>

    <script src="js/script.js"></script>
</body>

</html>